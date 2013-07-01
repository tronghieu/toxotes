<?php

namespace Flywheel\Filesystem;


use Flywheel\Config\ConfigHandler;
use Flywheel\Util\Folder;

class Uploader {
    private $_filterType;
    private $_requiredCheckMimeType = true;
    private $_allowedMineType = array();
    private $_error = array();
    private $_maxSize = 2; //2MB
    private $_dir;
    private $_data = array();
    private $_encryptFileName = false;
    private $_overwrite = false;
    private $_ansiName = true;
    private $_removeSpaceName = true;
    private $_field;
    private $_newName;
    private	$_fileMod = 755;

    /**
     * Constructor
     *
     * @param string	$dir
     * @param string	$field
     * @param array		$config
     */
    public function __construct($dir, $field = null, $config = array()) {
        $this->_allowedMimeType = ConfigHandler::load('global.config.mime');
        $this->_dir = $dir;
        $this->setFieldUpload($field);
        if (count($config) > 0) {
            if (isset($config['filter_type'])) {
                $this->setFilterType($config['filter_type']);
            }

            if (isset($config['max_size'])) {
                $this->setMaximumFileSize($config['max_size']);
            }

            if (isset($config['encrypt_file_name'])) {
                $this->setIsEncryptFileName($config['encrypt_file_name']);
            }

            if (isset($config['overwrite'])) {
                $this->setOverwriteIfExists($config['overwrite']);
            }

            if (isset($config['ansi_name'])) {
                $this->setUsingOnlyAnsiName($config['ansi_name']);
            }

            if (isset($config['remove_white_space'])) {
                $this->setRemoveWhiteSpaceInName($config['remove_white_space']);
            }

            if (isset($config['new_name']) && null != $config['new_name']) {
                $this->setNameAfterUploaded($config['new_name']);
            }
            if (isset($config['check_mime_type'])) {
                $this->setRequiredCheckMimeType($config['check_mime_type']);
            }

            if (isset($config['file_mode'])) {
                $this->setFilePermissionMod($config['file_mode']);
            }
        }
    }

    /**
     * set field name handler file upload
     * @param string		$field
     */
    public function setFieldUpload($field) {
        if ($this->_field != $field) {
            $this->_error = array(); //reset error file
            $this->_field = $field;
        }
    }

    /**
     * set has check mime type of file upload before move file upload
     *
     * @param boolean	$required
     */
    public function setRequiredCheckMimeType($required) {
        $this->_requiredCheckMimeType = (boolean) $required;
    }

    /**
     * set filter type filter mime type of file upload.
     * filter type is a string with file extension. Extension included has dot '.' or not.
     * you can filter one or many extension, each extension seperate with ',' char.
     * example: .jpg, .jpeg, .png, .bmp
     * @param string	$types
     */
    public function setFilterType($types) {
        $this->_filterType = $types;
    }

    /**
     * set max file upload size by Megabyte
     *
     * @param double $size
     */
    public function setMaximumFileSize($size) {
        $this->_maxSize = $size;
    }

    /**
     * set using encrypt file name after upload.
     * if set true this option. The file's name after upload has unique random string
     * @param boolean	$isEncrypt
     */
    public function setIsEncryptFileName($isEncrypt) {
        $this->_encryptFileName = (boolean) $isEncrypt;
    }

    /**
     * set overwrite exists file option
     *
     * @param boolean	$isOverwrite
     */
    public function setOverwriteIfExists($isOverwrite) {
        $this->_overwrite = (boolean) $isOverwrite;
    }

    /**
     * set using file name has only ansi character.
     *
     * @param boolean $isAnsiName
     */
    public function setUsingOnlyAnsiName($isAnsiName) {
        $this->_ansiName = (boolean) $isAnsiName;
    }

    /**
     * set remove white space file name
     * @param boolean $removeSpace
     */
    public function setRemoveWhiteSpaceInName($removeSpace) {
        $this->_removeSpaceName = (boolean) $removeSpace;
    }

    /**
     * set new name of file after uploaded
     * @param string	$name
     */
    public function setNameAfterUploaded($name) {
        $this->_newName = $name;
    }

    /**
     * set file permission
     *
     * @param integer	$mod
     */
    public function setFilePermissionMod($mod) {
        $this->_fileMod	= $mod;
    }

    /**
     * get original upload file name
     */
    public function getUploadFileName() {
        if ($this->_field != null) {
            return (isset($_FILES[$this->_field]['name']))
                ? $_FILES[$this->_field]['name'] : false;
        }

        return false;
    }

    /**
     * get Data of file after upload
     *
     * @return array
     */
    public function getData() {
        return $this->_data;
    }

    /**
     * do upload file
     * @param string	$field form input name of file upload
     *
     * @return boolean
     */
    public function upload($field = null) {
        if ($field != null) {
            $this->setFieldUpload($field);
        } else {
            $field = $this->_field;
        }

        if (false === $this->validate()) {
            return false;
        }

        $this->_dir = rtrim($this->_dir, DIRECTORY_SEPARATOR) .DIRECTORY_SEPARATOR;
        $this->_data['file_temp'] 		= $_FILES[$field]['tmp_name'];
        $this->_data['file_size'] 		= $_FILES[$field]['size'];
        $this->_data['file_origin_name']= $_FILES[$field]['name'];
        $this->_data['file_extension']	= $this->getExtension($this->_data['file_origin_name']);

        $this->_data['file_name'] 		= $this->_makeFileName();

        /*
         * Move the file to the final destination
         * To deal with different server configurations
         * we'll attempt to use copy() first.  If that fails
         * we'll use move_uploaded_file().  One of the two should
         * reliably work in most environments
         */
        if (!@copy($this->_data['file_temp'], $this->_dir .$this->_data['file_name'])) {
            if (!@move_uploaded_file($this->_data['file_temp'], $this->_dir .$this->_data['file_name'])) {
                $this->_error[] = 'upload file không thành công.';
                return false;
            }

        }
        @chmod($this->_dir .$this->_data['file_name'], $this->_fileMod);
        return true;
    }

    /**
     * validate upload field
     * @param string $field
     *
     * @return boolean
     */
    public function validate($field = null) {
        if (null == $field) {
            $field = $this->_field;
        }
        $valid = true;

        if (null == $field || !isset($_FILES[$field])) {
            $this->_error[] = 'Empty file upload or file upload not found in temp dir';
            return false;
        }
        $this->_dir = Folder::clean($this->_dir);
        if (null == $this->_dir) {
            $this->_error[] = 'Upload directory empty';
            $valid = false;
        }

        if (!is_dir($this->_dir) || !is_writeable($this->_dir)) {
            $this->_error[] = 'Upload directory not found or can not writable';
            $valid = false;
        }

        if ($_FILES[$field]['error'] != 0) {
            switch ($_FILES[$field]['error']) {
                case 1:
                    $this->_error[] = 'The file is too large (server)';
                    break;
                case 2:
                    $this->_error[] = 'The file is too large (form)';
                    break;
                case 3:
                    $this->_error[] = 'The file was only partially uploaded';
                    break;
                case 4:
                    $this->_error[] = 'No file was uploaded';
                    break;
                case 5:
                    $this->_error[] = 'The servers temporary folder is missing';
                    break;
                case 6:
                    $this->_error[]  = 'Failed to write to the temporary folder';
                    break;
            }
            return false;
        }

        if (true === $this->_requiredCheckMimeType) {
            if (false === $this->checkMineType($field)) {
                $valid = false;
            }
        }

        //check file size
        if ($_FILES[$field]['size']/1024 > $this->_maxSize) {
            $this->_error[] = 'File size is too big (more than allowed size:' .$this->_maxSize .' Kb)';
            $valid = false;
        }

        return $valid;
    }

    /**
     * check mine type of file upload
     *
     * @param $field
     * @return boolean
     */
    public function checkMineType($field) {
        if (null != $this->_filterType) { //defined filter by Type
            $ext = explode(',', $this->_filterType);
            $mime = array();
            $mime = array();
            for ($i = 0; $i < sizeof($ext); ++$i) {
                $ext[$i] = strtolower(ltrim(trim($ext[$i]), '.'));
                $mime[$ext[$i]] = $this->_allowedMimeType[$ext[$i]];
            }
        } else {
            $mime = $this->_allowedMimeType;
        }
        $ext = $this->getExtension($_FILES[$field]['name'], false);
        $fileMimeType = $this->getMimeTypeByExtension($ext, $mime);
        if (is_array($fileMimeType)) {
            if (!in_array($_FILES[$field]['type'], $fileMimeType)) {
                $this->_error[] = 'Mime type does not allow.';
                return false;
            }
        } elseif (is_string($fileMimeType)) {
            if ($fileMimeType != $_FILES[$field]['type']) {
                $this->_error[] = 'Mine type does not allow.';
                return false;
            }
        } elseif (false == $fileMimeType) {
            $this->_error[] = 'Mine type does not allow.';
            return false;
        }

        return true;
    }

    /**
     * get file extension
     * @param string	$fileName
     * @param boolean	$includeDot return extension include dot char like ".jpg"
     *
     * @return string
     */
    public function getExtension($fileName, $includeDot = true) {
        $x = explode('.', $fileName);
        return ($includeDot)? '.' .strtolower(end($x)) : strtolower(end($x));
    }

    /**
     * get mime type by file extension
     * @param string	$extension
     * @param array		$mime. default null, mean using defined system's mime type
     *
     * @return mixed string|array
     * 				false	if extension not has defined mime type
     */
    public function getMimeTypeByExtension($extension, $mime = null) {
        if (null === $mime || !is_array($mime) || count($mime) == 0) {
            $mime = $this->_allowedMimeType;
        }

        return ((isset($mime[$extension]))? $mime[$extension] : false);
    }

    /**
     * make file name after upload
     *
     * @return string filename included extension
     */
    private function _makeFileName() {
        if (true == $this->_encryptFileName) {
            return (uniqid() .$this->_data['file_extension']);
        }

        if (null != $this->_newName) {
            $name = Folder::cleanFileName($this->_newName);
        } else {
            $name = Folder::cleanFileName($this->_data['file_origin_name']);
            $name = str_replace($this->_data['file_extension'], '', $name);
        }

        if (false !== $this->_ansiName) {
            $name = preg_replace('/[^A-Za-z0-9_\-]/', '', $name);
        }

        if (false !== $this->_removeSpaceName) {
            $name = preg_replace('/\s+/', '-', $name);
        }

        if (true !== $this->_overwrite
            && (file_exists($this->_dir .$name .$this->_data['file_extension']))) {
            $i = 1;
            do {
                $_t = $name .'(' .$i .')';
                ++$i;
            } while (file_exists($this->_dir .$_t .$this->_data['file_extension']));
            $name = $_t;
        }

        return $name .$this->_data['file_extension'];
    }

    /**
     * @return array|bool
     */
    public function hasError() {
        return (boolean) sizeof($this->_error);
    }

    public function getError() {
        return $this->_error;
    }

    /**
     * reset config
     * @param boolean	 $includeResetMimeType
     */
    public function reset($includeResetMimeType = false) {
        $this->_filterType = null;
        if (true === $includeResetMimeType) {
            $this->_allowedMimeType = array();
        }
        $this->_error = array();
        $this->_maxSize = 2; //2MB
        $this->_dir = null;
        $this->_data = array();
        $this->_encryptFileName = false;
        $this->_overwrite = false;
        $this->_ansiName = true;
        $this->_removeSpaceName = true;
        $this->_field = null;

    }

    public function __destruct() {
        $this->_error = array();
        $this->_allowedMimeType = array();
        $this->_data = array();
    }
}