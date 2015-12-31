$(document).ready(function() {
    if ("undefined" != typeof Handlebars) {
        Roles.init();
    }
});

Roles = {
    listTmp: null,

    init : function() {
        this.listTmp = Handlebars.compile($("#_role-template").html());
        $("#_role-container").html(this.listTmp({"roles" : roles}));
    }
};