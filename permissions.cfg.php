<?php
const PERMISSION_USER_VIEW = 'USER_VIEW';
const PERMISSION_USER_CREATE = 'USER_CREATE';
const PERMISSION_USER_INFO_EDIT = 'USER_INFO_EDIT';
const PERMISSION_USER_DELETE = 'USER_DELETE';
const PERMISSION_USER_ADDRESS_EDIT = 'USER_ADDRESS_EDIT';
const PERMISSION_USER_MOBILE_EDIT = 'USER_MOBILE_EDIT';
const PERMISSION_USER_VIEW_FINANCE = 'USER_VIEW_FINANCE';
const PERMISSION_USER_PROCURACY = 'USER_PROCURACY';

const PERMISSION_ROLE_VIEW = 'ROLE_VIEW';
const PERMISSION_ROLE_EDIT = 'ROLE_EDIT';
const PERMISSION_USER_ROLE_MANAGE = 'USER_ROLE_MANAGE';
const PERMISSION_ROLE_PERMISSION_MANAGE = 'ROLE_PERMISSION_MANAGE';
const PERMISSION_ROLE_DELETE = 'ROLE_DELETE';

const PERMISSION_DEPOSIT_LIST_VIEW = 'DEPOSIT_LIST_VIEW';
const PERMISSION_DEPOSIT_DETAIL_VIEW = 'DEPOSIT_DETAIL_VIEW';
const PERMISSION_DEPOSIT_CREATE = 'DEPOSIT_CREATE';
const PERMISSION_DEPOSIT_APPROVAL = 'DEPOSIT_APPROVAL';
const PERMISSION_DEPOSIT_REFUSE = 'DEPOSIT_REFUSE';

const PERMISSION_SYSTEM_MANAGE = 'SYSTEM_MANAGE';
const PERMISSION_SYSTEM_CONFIG = 'SYSTEM_CONFIG';

class PermissionsCfg {
    public static $list = [
        'deposit' => [
            'label' => 'Phiếu nạp, tạo phiếu, duyệt phiếu, hủy phiếu',
            'permissions' => [
                PERMISSION_DEPOSIT_LIST_VIEW => [
                    'label' => 'Xem danh sách phiếu nạp',
                    'description' => 'Xem danh sách phiếu nạp',
                ],
                PERMISSION_DEPOSIT_DETAIL_VIEW => [
                    'label' => 'Xem chi tiết phiếu nạp tiền',
                    'description' => 'Quyền cho phép xem chi tiết phiếu nạp tiền',
                ],
                PERMISSION_DEPOSIT_APPROVAL => [
                    'label' => 'Duyệt phiếu nạp',
                    'description' => 'Quyền cho phép duyệt các phiếu nạp',
                ],
                PERMISSION_DEPOSIT_REFUSE => [
                    'label' => 'Từ chối phiếu nạp',
                    'description' => 'Quyền từ chối phiếu nạp',
                ],
                PERMISSION_DEPOSIT_CREATE => [
                    'label' => 'Tạo phiếu nạp',
                    'description' => 'Quyền cho phép tạo phiếu nạp',
                ],
            ],
        ],

        'user_role_permission' => [
            'label' => 'Người dùng, nhóm, phân quyền',
            'permissions' => [
                PERMISSION_USER_VIEW => [
                    'label' => 'Xem thông tin người dùng',
                    'description' => 'Quyền cho phép quản trị viên xem thông tin người dùng',
                ],

                PERMISSION_USER_CREATE => [
                    'label' => 'Thêm người dùng',
                    'description' => 'Cho phép thêm một user mới',
                ],

                PERMISSION_USER_INFO_EDIT => [
                    'label' => 'Sửa thông tin người dùng',
                    'description' => 'Quyền cho phép quản trị viên thêm, sửa, xóa thông tin người dùng',
                ],

                PERMISSION_USER_DELETE => [
                    'label' => 'Xóa thông tin người dùng',
                    'description' => 'Quyền cho phép nhân viên xóa thông tin người dùng',
                ],

                PERMISSION_ROLE_VIEW => [
                    'label' => 'Xem thông tin nhóm',
                    'description' => 'Quyền cho phép quản trị viên xem thông tin nhóm',
                ],

                PERMISSION_ROLE_EDIT => [
                    'label' => 'Thêm và sửa thông tin nhóm',
                    'description' => 'Quyền cho phép quản trị viên sửa thông tin nhóm',
                ],

                PERMISSION_ROLE_DELETE => [
                    'label' => 'Xóa nhóm',
                    'description' => 'Quyền cho phép quản trị viên xóa bỏ nhóm',
                ],

                PERMISSION_ROLE_PERMISSION_MANAGE => [
                    'label' => 'Quản lý quyền của nhóm',
                    'description' => 'Quyền cho phép quản trị viên quản lý quyền trong nhóm',
                ],
            ],
        ],

        'system' => [
            'label' => 'Hệ thống',
            'permissions' => [
                PERMISSION_SYSTEM_CONFIG => [
                    'label' => 'Thay đổi cấu hình hệ thống',
                    'description' => 'Đường dẫn web, mô tả v.v...',
                ]
            ]
        ],
    ];
}