var sRow = 0;
$(document).ready(function () {
    let isUserAuditTrailDataTableInitialized = false;
    let isAccessConfigAuditTrailDataTableInitialized = false;
    let isTeamAuditTrailDataTableInitialized = false;
    let isSecurityPolicyAuditTrailDataTableInitialized = false;
    let isGeneralSettingAuditTrailDataTableInitialized = false;
    let isMaskingNumberAuditTrailDataTableInitialized = false;
    let latestSelectedActionType = '';
    let currentTab = 'user';

    if (!userContext.getPermission('is_users_audit_trail_enabled')) {
        $('#audit-trail-user-tab').remove();
        $('#audit-trail-user-tab-page').remove();
    }
    
    if (!userContext.getPermission('is_access_config_audit_trail_enabled')) {
        $('#audit-trail-access-config-tab').remove();
        $('#audit-trail-access-config-tab-page').remove();
    }

    if (!userContext.getPermission('is_teams_audit_trail_enabled')) {
        $('#audit-trail-team-tab').remove();
        $('#audit-trail-team-tab-page').remove();
    }
    
    if (!userContext.getPermission('is_security_policy_audit_trail_enabled')) {
        $('#audit-trail-security-policy-tab').remove();
        $('#audit-trail-security-policy-tab-page').remove();
    }

    if (!userContext.getPermission('is_general_setting_audit_trail_enabled')) {
        $('#audit-trail-general-setting-tab').remove();
        $('#audit-trail-general-setting-tab-page').remove();
    }

    if (!userContext.getPermission('is_failed_login_log_audit_trail_enabled')) {
        $('#audit-trail-failed-login-tab').remove();
        $('#audit-trail-failed-login-tab-page').remove();
    }

    if (!userContext.getPermission('is_masking_number_list_audit_trail_enabled') || volareconfig.ENABLE_MASKING_NUMBER_CREATE_UPDATE == 1) {
        $('#audit-trail-masking-number-tab').remove();
        $('#audit-trail-masking-number-tab-page').remove();
    }

    let userAuditTrailParams = {
        module: 'users',
        dateRangeFrom: moment().format('YYYY-MM-DD'),
        dateRangeTo: moment().format('YYYY-MM-DD'),
        actionType: ''
    };

    let accessConfigAuditTrailParams = {
        module: 'accessConfigs',
        dateRangeFrom: moment().format('YYYY-MM-DD'),
        dateRangeTo: moment().format('YYYY-MM-DD'),
        actionType: ''
    };

    let teamAuditTrailParams = {
        module: 'teams',
        dateRangeFrom: moment().format('YYYY-MM-DD'),
        dateRangeTo: moment().format('YYYY-MM-DD'),
        actionType: ''
    };

    let securityPolicyAuditTrailParams = {
        module: 'securityPolicy',
        dateRangeFrom: moment().format('YYYY-MM-DD'),
        dateRangeTo: moment().format('YYYY-MM-DD'),
        actionType: ''
    };

    let generalSettingAuditTrailParams = {
        module: 'generalSetting',
        dateRangeFrom: moment().format('YYYY-MM-DD'),
        dateRangeTo: moment().format('YYYY-MM-DD'),
        actionType: ''
    };

    let failedLoginAuditTrailParams = {
        module: 'failedlogin',
        dateRangeFrom: moment().format('YYYY-MM-DD'),
        dateRangeTo: moment().format('YYYY-MM-DD'),
        actionType: 'summary',
        username : ''
    };

    let maskingNumberAuditTrailParams = {
        module: 'maskingNumber',
        dateRangeFrom: moment().format('YYYY-MM-DD'),
        dateRangeTo: moment().format('YYYY-MM-DD'),
        actionType: ''
    };

    let auditTrailParams = {};

    //To trigger date range picker
    $('input[name="daterange"]').daterangepicker({
        opens: 'right'
    }, function (start, end, label) {
        if (currentTab === 'user') {
            userAuditTrailParams.dateRangeFrom = start.format('YYYY-MM-DD 00:00:00');
            userAuditTrailParams.dateRangeTo = end.format('YYYY-MM-DD 23:59:59');
        }
        else if (currentTab === 'access_config') {
            accessConfigAuditTrailParams.dateRangeFrom = start.format('YYYY-MM-DD 00:00:00');
            accessConfigAuditTrailParams.dateRangeTo = end.format('YYYY-MM-DD 23:59:59');
        }
        else if (currentTab === 'team') {
            teamAuditTrailParams.dateRangeFrom = start.format('YYYY-MM-DD 00:00:00');
            teamAuditTrailParams.dateRangeTo = end.format('YYYY-MM-DD 23:59:59');
        }
        else if (currentTab === 'security_policy') {
            securityPolicyAuditTrailParams.dateRangeFrom = start.format('YYYY-MM-DD 00:00:00');
            securityPolicyAuditTrailParams.dateRangeTo = end.format('YYYY-MM-DD 23:59:59');
        }
        else if (currentTab === 'general_setting') {
            generalSettingAuditTrailParams.dateRangeFrom = start.format('YYYY-MM-DD 00:00:00');
            generalSettingAuditTrailParams.dateRangeTo = end.format('YYYY-MM-DD 23:59:59');
        }
        else if (currentTab === 'failed_login') {
            failedLoginAuditTrailParams.dateRangeFrom = start.format('YYYY-MM-DD 00:00:00');
            failedLoginAuditTrailParams.dateRangeTo = end.format('YYYY-MM-DD 23:59:59');
        }
        else if (currentTab === 'masking_number') {
            maskingNumberAuditTrailParams.dateRangeFrom = start.format('YYYY-MM-DD 00:00:00');
            maskingNumberAuditTrailParams.dateRangeTo = end.format('YYYY-MM-DD 23:59:59');
        }
    });

    $('input[type=radio]').change(function () {
        if (currentTab === 'user') {
            userAuditTrailParams.actionType = $(this).val();
        }
        else if (currentTab === 'access_config') {
            accessConfigAuditTrailParams.actionType = $(this).val();
        }
        else if (currentTab === 'team') {
            teamAuditTrailParams.actionType = $(this).val();
        }
        else if (currentTab === 'security_policy') {
            securityPolicyAuditTrailParams.actionType = $(this).val();
        }
        else if (currentTab === 'failed_login') {
            failedLoginAuditTrailParams.actionType = $(this).val();
        }
        else if (currentTab === 'masking_number') {
            maskingNumberAuditTrailParams.actionType = $(this).val();
        }
    });

    $('#failed_login_audit_trail_daterange').daterangepicker({
        maxDate: moment(),
        maxSpan: { days: 60 },
    });
    $('#failed_login_audit_trail_daterange').change(function(){
        dtDate = $(this).val().split('-');
        failedLoginAuditTrailParams.dateRangeFrom = moment(dtDate[0], 'MM/DD/YYYY').format(volareconfig.MOMENT_SQL_DATE_FORMAT);
        failedLoginAuditTrailParams.dateRangeTo = moment(dtDate[1], 'MM/DD/YYYY').format(volareconfig.MOMENT_SQL_DATE_FORMAT);
    }); 

    $("#failed_login_audit_trail_username").on("keyup", function () {
        failedLoginAuditTrailParams.username = $(this).val();
    });

    $('#audit-trail-user-tab').off('click');
    $('#audit-trail-user-tab').on('click', function () {
        currentTab = 'user';
    });

    $('#audit-trail-access-config-tab').off('click');
    $('#audit-trail-access-config-tab').on('click', function () {
        currentTab = 'access_config';
    });

    $('#audit-trail-team-tab').off('click');
    $('#audit-trail-team-tab').on('click', function () {
        currentTab = 'team';
    });

    $('#audit-trail-security-policy-tab').off('click');
    $('#audit-trail-security-policy-tab').on('click', function () {
        currentTab = 'security_policy';
    });

    $('#audit-trail-general-setting-tab').off('click');
    $('#audit-trail-general-setting-tab').on('click', function () {
        currentTab = 'general_setting';
    });

    $('#audit-trail-failed-login-tab').off('click');
    $('#audit-trail-failed-login-tab').on('click', function () {
        currentTab = 'failed_login';
    });

    $('#audit-trail-masking-number-tab').off('click');
    $('#audit-trail-masking-number-tab').on('click', function () {
        currentTab = 'masking_number';
    });

    $('#user_audit_trail_button_search').off('click');
    $('#user_audit_trail_button_search').on('click', function () {
        auditTrailPageService.searchUserAuditTrail();
    });

    $('#access_config_audit_trail_button_search').off('click');
    $('#access_config_audit_trail_button_search').on('click', function () {
        auditTrailPageService.searchAccessConfigAuditTrail();
    });

    $('#team_audit_trail_button_search').off('click');
    $('#team_audit_trail_button_search').on('click', function () {
        auditTrailPageService.searchTeamAuditTrail();
    });

    $('#security_policy_audit_trail_button_search').off('click');
    $('#security_policy_audit_trail_button_search').on('click', function () {
        auditTrailPageService.searchSecurityPolicyAuditTrail();
    });

    $('#general_setting_audit_trail_button_search').off('click');
    $('#general_setting_audit_trail_button_search').on('click', function () {
        auditTrailPageService.searchGeneralSettingAuditTrail();
    });

    $('#failed_login_audit_trail_button_search').off('click');
    $('#failed_login_audit_trail_button_search').on('click', function () {
        auditTrailPageService.searchFailedLoginAuditTrail();
    });

    $('#masking_number_audit_trail_button_search').off('click');
    $('#masking_number_audit_trail_button_search').on('click', function () {
        auditTrailPageService.searchMaskingNumberAuditTrail();
    });

    let auditTrailPageService = (function () {
        function initAuditTrailDataTable(dataTableId, columns, dataTableTitle) {
            $.fn.dataTable.ext.errMode = 'none';
            $(dataTableId)
                .on('error.dt',
                    function (e, settings, techNote, message) {
                        console.error(lang.Setting_AuditTrail_ErrorReportedByDataTables + ' ', message);
                    })
                .DataTable({
                    'paging': false,
                    'deferRender': true,
                    'serverSide': true,
                    'scrollY': "calc(100vh - 64vh)",
                    'scrollCollapse': true,
                    'sScrollX': "100%",
                    'scrollX': false,
                    'info': true,
                    'ordering': false,
                    'searching': false,
                    'processing': true,
                    'ajax': function (data, callback, settings) {
                        setTimeout(function () {
                            username = auditTrailParams.module == 'failedlogin' ? '&username=' + auditTrailParams.username : '';
                            auditTrailService.getListAuditTrail(
                                auditTrailParams.module,
                                '?take=all' +
                                '&skip=' + data.start +
                                '&date_range_from=' + auditTrailParams.dateRangeFrom + ' 00:00:00' +
                                '&date_range_to=' + auditTrailParams.dateRangeTo + ' 23:59:59' +
                                '&action_type=' + auditTrailParams.actionType
                                +username,
                                function (json) {
                                    let sDataItem = json.items;

                                    var i;
                                    for (i = 0; i < json.items.length; i++)
                                    {
                                        sDataItem[i].id = data.start + (i + 1);
                                    }

                                    callback({
                                        draw: data.draw,
                                        data: sDataItem,
                                        recordsTotal: json.total,
                                        recordsFiltered: json.total
                                    });
                                },
                                function (httpResponse) {
                                    volareFailNotify(lang.Common_Error + "!", httpResponse);
                                });
                        }, 50);
                    },
                    'columns': columns,
                    'fnDrawCallback' : function(){
                        var heightUsersTable = $('#user_audit_trail_data_table tbody').height();
                        var heightAccessConfigTable = $('#access_config_audit_trail_data_table tbody').height();
                        var heightTeamsTable  = $('#team_audit_trail_data_table tbody').height();
                        var heightSecurityPolicyTable  = $('#access_config_security_policy_data_table tbody').height();
                        var heightGeneralSettingTable  = $('#access_config_general_setting_data_table tbody').height();
                        var heightFailedLoginSummaryTable = $('#failed_login_summary_data_table tbody').height();
                        var heightFailedLoginDetailTable = $('#failed_login_detail_data_table tbody').height();
                        var heightMaskingNumberTable = $('#masking_number_audit_trail_data_table tbody').height();
                        $('#user_audit_trail_data_table_wrapper .dataTables_scrollBody').children('div').css('height' , heightUsersTable + 'px');
                        $('#access_config_audit_trail_data_table_wrapper .dataTables_scrollBody').children('div').css('height' , heightAccessConfigTable + 'px');
                        $('#team_audit_trail_data_table_wrapper .dataTables_scrollBody').children('div').css('height' , heightTeamsTable + 'px');
                        $('#access_config_security_policy_data_table_wrapper .dataTables_scrollBody').children('div').css('height' , heightSecurityPolicyTable + 'px');
                        $('#access_config_general_setting_data_table_wrapper .dataTables_scrollBody').children('div').css('height' , heightGeneralSettingTable + 'px');
                        $('#failed_login_summary_data_table_wrapper .dataTables_scrollBody').children('div').css('height', heightFailedLoginSummaryTable + 'px');
                        $('#failed_login_detail_data_table_wrapper .dataTables_scrollBody').children('div').css('height', heightFailedLoginDetailTable + 'px');
                        $('#masking_number_audit_trail_data_table .dataTables_scrollBody').children('div').css('height', heightMaskingNumberTable + 'px');
                    },                         
                    dom: 'Bfrtip',
                    buttons:[
                        {
                            extend: 'excelHtml5',
                            title: dataTableTitle,
                            className: 'ml-2 export_button',
                            text: '<i class="fa fa-download"></i>',
                            exportOptions: {
                                format: {
                                    body: function(data, column, row) {
                                        if (typeof data === 'string' || data instanceof String) {
                                            data = data.replace(/<br\s*\/?>/ig, "\r\n");
                                        }
                                        return data;
                                    }
                                }
                            },
                            customize : function(xlsx){
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                $('row c', sheet).each( function () {
                                    $(this).attr( 's', '55' );
                                });      
                            }
                        }
                    ]
                });
                if (volareconfig.SETTING_EXPORT_ACCESS_CONFIG == 1 && userContext.getPermission('is_setting_export_enabled') == 1) {
                    $('.export_button').show();
                } else if (volareconfig.SETTING_EXPORT_ACCESS_CONFIG == 0) {
                    $('.export_button').show();
                } else {
                    $('.export_button').remove();
                }
        }

        return {

            searchUserAuditTrail: function () {
                auditTrailParams = userAuditTrailParams;

                if (isUserAuditTrailDataTableInitialized) {
                    $('#user_audit_trail_data_table').DataTable().clear();
                    $('#user_audit_trail_data_table').DataTable().draw();
                    $('#user_audit_trail_data_table').DataTable().scroller.toPosition(0);
                }
                else {
                    initAuditTrailDataTable('#user_audit_trail_data_table',
                        [
                            { 'data': 'id' },
                            { 'data': 'username',
                                mRender: function (data, type, row) {
                                    if (row.username != null){
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";
                                    }
                                }
                            },
                            { 'data': 'role_name' ,
                                mRender: function (data, type, row) {
                                    if (row.role_name != null){
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";
                                    }
                                }},
                            { 'data': 'object_created_at',
                                mRender: function (data, type, row) {
                                    if (row.object_created_at != null)
                                    {
                                        vobject_created_at = moment(row.object_created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                                        return stripHTML(vobject_created_at);
                                    }
                                    else{
                                        return "";
                                    }
                                }},
                            { 'data': 'object_created_by',
                                mRender: function (data, type, row) {
                                    if (row.object_created_by != null) {
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";   
                                    }
                                }},
                            { 'data': 'created_at',
                                mRender: function (data, type, row) {
                                    if (row.created_at != null)
                                    {
                                        vcreated_at = moment(row.created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                                        return stripHTML(vcreated_at);
                                    }
                                    else{
                                        return "";   
                                    }
                                }},
                            { 'data': 'created_by',
                                mRender: function (data, type, row) {
                                    if (row.created_by != null) {
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";   
                                    }
                                }},
                            {
                                mRender: function (data, type, row) {
                                    return auditTrailActivityService.constructListActivity(row);
                                }
                            },
                        ], 'User Audit Trail');
                    isUserAuditTrailDataTableInitialized = true;
                }
            },

            searchAccessConfigAuditTrail: function () {
                auditTrailParams = accessConfigAuditTrailParams;

                if (isAccessConfigAuditTrailDataTableInitialized) {
                    $('#access_config_audit_trail_data_table').DataTable().clear();
                    $('#access_config_audit_trail_data_table').DataTable().draw();
                    $('#access_config_audit_trail_data_table').DataTable().scroller.toPosition(0);
                }
                else {
                    initAuditTrailDataTable('#access_config_audit_trail_data_table',
                        [
                            { 'data': 'id' },
                            { 'data': 'role_name' ,
                                mRender: function (data, type, row) {
                                    if (row.role_name != null) {
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";
                                    }
                                }},
                            { 'data': 'object_created_at',
                                mRender: function (data, type, row) {
                                    if (row.object_created_at != null)
                                    {
                                        var vobject_created_at = moment(row.object_created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                                        return stripHTML(vobject_created_at);
                                    }
                                    else{
                                        return "";
                                    }
                                }},
                            { 'data': 'object_created_by',
                                mRender: function (data, type, row) {
                                    if (row.object_created_by != null){
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";
                                    }
                                }},
                            { 'data': 'created_at',
                                mRender: function (data, type, row) {
                                    if (row.created_at != null)
                                    {
                                        var vcreated_at = moment(row.created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                                        return stripHTML(vcreated_at);
                                    }
                                    else{
                                        return "";
                                    }
                                }},
                            { 'data': 'created_by',
                                mRender: function (data, type, row) {
                                    if (row.created_by != null) {
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";
                                    }
                                }},
                            {
                                mRender: function (data, type, row) {
                                    return auditTrailActivityService.constructListActivity(row);
                                }
                            }
                        ], 'Access Config Audit Trail');
                    isAccessConfigAuditTrailDataTableInitialized = true;
                }
            },

            searchTeamAuditTrail: function () {
                auditTrailParams = teamAuditTrailParams;

                if (isTeamAuditTrailDataTableInitialized) {
                    $('#team_audit_trail_data_table').DataTable().clear();
                    $('#team_audit_trail_data_table').DataTable().draw();
                    $('#team_audit_trail_data_table').DataTable().scroller.toPosition(0);
                }
                else {
                    initAuditTrailDataTable('#team_audit_trail_data_table',
                        [
                            { 'data': 'id' },
                            { 'data': 'role_name' ,
                                mRender: function (data, type, row) {
                                    if (row.role_name != null){
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";   
                                    }
                                }},
                            { 'data': 'object_created_at',
                                mRender: function (data, type, row) {
                                    if (row.object_created_at != null)
                                    {
                                        var vobject_created_at = moment(row.object_created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                                        return stripHTML(vobject_created_at);
                                    }
                                    else{
                                        return "";   
                                    }         
                                }
                            },
                            { 'data': 'object_created_by',
                                mRender: function (data, type, row) {
                                    if (row.object_created_by != null){
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";   
                                    }     
                                }},
                            { 'data': 'created_at',
                                mRender: function (data, type, row) {
                                    if (row.created_at != null)
                                    {
                                        var vcreated_at  = moment(row.created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";   
                                    }                                  
                                }},
                            { 'data': 'created_by',
                                mRender: function (data, type, row) {
                                    if (row.created_by != null){
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";   
                                    }   
                                }},
                            {
                                mRender: function (data, type, row) {
                                    return auditTrailActivityService.constructListActivity(row);
                                }
                            }
                        ], 'Team Audit Trail');
                    isTeamAuditTrailDataTableInitialized = true;
                }
            },

            searchSecurityPolicyAuditTrail: function () {
                auditTrailParams = securityPolicyAuditTrailParams;
                if (isSecurityPolicyAuditTrailDataTableInitialized) {
                    $('#access_config_security_policy_data_table').DataTable().clear();
                    $('#access_config_security_policy_data_table').DataTable().draw();
                    $('#access_config_security_policy_data_table').DataTable().scroller.toPosition(0);
                }
                else {
                    initAuditTrailDataTable('#access_config_security_policy_data_table',
                        [
                            { 'data': 'id' },
                            { 'data': 'object_created_at',
                                mRender: function (data, type, row) {
                                    if (row.object_created_at != null)
                                    {
                                        var created_date = moment(row.object_created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                                        return stripHTML(created_date);
                                    }
                                }
                            },
                            { 'data': 'object_created_by',
                                mRender: function (data, type, row) {
                                    return stripHTML(data);
                                }
                            },
                            { 'data': 'created_at',
                                mRender: function (data, type, row) {
                                    if (row.created_at != null)
                                    {
                                        var modified_date  = moment(row.created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                                        return stripHTML(modified_date);
                                    }
                                }
                            },
                            { 'data': 'created_by',
                                mRender: function (data, type, row) {
                                    return stripHTML(data);
                                }
                            },
                            {
                                mRender: function (data, type, row) {
                                    return auditTrailActivityService.constructListActivity(row);
                                }
                            },
                        ], 'Security Policy Audit Trail');
                    isSecurityPolicyAuditTrailDataTableInitialized = true;
                }
            },

            searchGeneralSettingAuditTrail: function () {
                auditTrailParams = generalSettingAuditTrailParams;
                if (isGeneralSettingAuditTrailDataTableInitialized) {
                    $('#access_config_general_setting_data_table').DataTable().clear();
                    $('#access_config_general_setting_data_table').DataTable().draw();
                    $('#access_config_general_setting_data_table').DataTable().scroller.toPosition(0);
                }
                else {
                    initAuditTrailDataTable('#access_config_general_setting_data_table',
                        [
                            { 'data': 'id' },
                            // {
                            //     'data': 'object_created_at',
                            //     mRender: function (data, type, row) {
                            //         if (row.object_created_at != null)
                            //         {
                            //             var created_date = moment(row.object_created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                            //             return stripHTML(created_date);
                            //         }
                            //     }
                            // },
                            // { 
                            //     'data': 'object_created_by',
                            //     'visible': false,
                            //     mRender: function (data, type, row) {
                            //         return stripHTML(data);
                            //     }
                            // },
                            {  'data': 'created_at',
                                mRender: function (data, type, row) {
                                    if (row.created_at != null)
                                    {
                                        var modified_date  = moment(row.created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                                        return stripHTML(modified_date);
                                    }
                                }
                            },
                            { 'data': 'created_by',
                                mRender: function (data, type, row) {
                                    return stripHTML(data);
                                }
                            },
                            {
                                mRender: function (data, type, row) {
                                    return auditTrailActivityService.constructListActivity(row);
                                }
                            },
                        ], 'Company Setting Audit Trail');
                    isGeneralSettingAuditTrailDataTableInitialized = true;
                }
            },
            searchFailedLoginAuditTrail: function () {
                faildLoginActionType = $('input[name="FaildLoginActionType"]:checked').val();
                auditTrailParams = failedLoginAuditTrailParams;
                
                if (faildLoginActionType == 'summary'){
                    $('#failed_login_detail_data_table').hide();
                    $("#failed_login_detail_data_table_wrapper").hide();
                    $('#failed_login_summary_data_table').show();
                    $("#failed_login_summary_data_table_wrapper").show();
                }
                else
                {
                    $('#failed_login_summary_data_table').hide();
                    $("#failed_login_summary_data_table_wrapper").hide();
                    $('#failed_login_detail_data_table').show();
                    $("#failed_login_detail_data_table_wrapper").show();
                }
                
                table = faildLoginActionType == 'summary' ? '#failed_login_summary_data_table' : '#failed_login_detail_data_table';
                if (isGeneralSettingAuditTrailDataTableInitialized && latestSelectedActionType == faildLoginActionType) {
                    $(table).DataTable().clear();
                    $(table).DataTable().draw();
                    $(table).DataTable().scroller.toPosition(0);
                }
                else {
                    if(faildLoginActionType == 'summary'){
                        initAuditTrailDataTable('#failed_login_summary_data_table',
                            [
                                { 'data': 'id' },
                                {
                                    'data': 'username',
                                    mRender: function (data, type, row) {
                                        return stripHTML(data);
                                    }
                                },
                                {
                                    'data': 'failed_count',
                                    mRender: function (data, type, row) {
                                        return stripHTML(data);
                                    }
                                },
                            ], 'Failed Login Audit Trail');
                    }
                    else{ 
                        initAuditTrailDataTable('#failed_login_detail_data_table',
                            [
                                { 'data': 'id' },
                                {
                                    'data': 'username',
                                    mRender: function (data, type, row) {
                                        return stripHTML(data);
                                    }
                                },
                                {
                                    'data': 'module',
                                    mRender: function (data, type, row) {
                                        return stripHTML(data);
                                    }
                                },
                                {
                                    'data': 'failed_login_time',
                                    mRender: function (data, type, row) {
                                        return stripHTML(data);
                                    }
                                },
                                {
                                    'data': 'ip_address',
                                    mRender: function (data, type, row) {
                                        return stripHTML(data);
                                    }
                                },
                                {
                                    'data': 'reason',
                                    mRender: function (data, type, row) {
                                        return stripHTML(data);
                                    }
                                },
                            ], 'Failed Login Audit Trail'); 
                    }
                    $(table).DataTable().clear();
                    $(table).DataTable().draw();
                    $(table).DataTable().scroller.toPosition(0);
                    latestSelectedActionType = faildLoginActionType;
                    isGeneralSettingAuditTrailDataTableInitialized = true;
                }
            },

            searchMaskingNumberAuditTrail: function (){
                auditTrailParams = maskingNumberAuditTrailParams;

                if (isMaskingNumberAuditTrailDataTableInitialized) {
                    $('#masking_number_audit_trail_data_table').DataTable().clear();
                    $('#masking_number_audit_trail_data_table').DataTable().draw();
                    $('#masking_number_audit_trail_data_table').DataTable().scroller.toPosition(0);
                }
                else {
                    initAuditTrailDataTable('#masking_number_audit_trail_data_table',
                        [
                            { 'data': 'id' },
                            { 'data': 'object_created_at',
                                mRender: function (data, type, row) {
                                    if (row.object_created_at != null)
                                    {
                                        var vobject_created_at = moment(row.object_created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                                        return stripHTML(vobject_created_at);
                                    }
                                    else{
                                        return "";   
                                    }         
                                }
                            },
                            { 'data': 'object_created_by',
                                mRender: function (data, type, row) {
                                    if (row.object_created_by != null){
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";   
                                    }     
                                }},
                            { 'data': 'created_at',
                                mRender: function (data, type, row) {
                                    if (row.created_at != null)
                                    {
                                        var vcreated_at  = moment(row.created_at, serverDetails.MOMENT_SQL_DATETIME_FORMAT).format(serverDetails.MOMENT_GRID_COLUMN_DATETIME_FORMAT);
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";   
                                    }                                  
                                }},
                            { 'data': 'created_by',
                                mRender: function (data, type, row) {
                                    if (row.created_by != null){
                                        return stripHTML(data);
                                    }
                                    else{
                                        return "";   
                                    }   
                                }},
                            {
                                mRender: function (data, type, row) {
                                    return auditTrailActivityService.constructListActivity(row);
                                }
                            }
                        ], 'Masking Number Audit Trail');
                    isMaskingNumberAuditTrailDataTableInitialized = true;
                }
            }
        };
    })();

    $('nav[role=tablist]').children().first().click();
});