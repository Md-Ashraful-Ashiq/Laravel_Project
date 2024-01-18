$(document).ready(function () {
    function displayRolePermissions() {
        const selectedRole = $('#access_config_role option:selected');
        if (selectedRole.length > 0) {
            const isAdminEnabled = selectedRole.data('admin-enabled');
            const isSettingsEnabled = selectedRole.data('settings-enabled');
            const isOperationEnabled = selectedRole.data('operation-enabled');
            const isAuditEnabled = selectedRole.data('audit-enabled');
            const userCount = selectedRole.data('users-count');

            // Update the checkbox states
            $('#access_config_is_admin_site_enabled').prop('checked', isAdminEnabled);
            $('#access_config_is_settings_site_enabled').prop('checked', isSettingsEnabled);
            $('#access_config_is_operation_site_enabled').prop('checked', isOperationEnabled);
            $('#access_config_is_audit_site_enabled').prop('checked', isAuditEnabled);

            // Update the user count in the label
            $('#access_config_user_count').html(`( ${userCount} Users)`);

            // Show/hide sub-cards based on the "Settings" checkbox state
            toggleSubCards(isSettingsEnabled);

            // Check if isAuditEnabled is true
            if (isAuditEnabled) {
                // Show the Audit Trail button
                $('#audit-button').show();
            } else {
                // Hide the Audit Trail button
                $('#audit-button').hide();
            }

            // Check if isOperationEnabled is true
            if (isOperationEnabled) {
                // Show the Users button
                $('#operation-management-button').show();
            } else {
                // Hide the Users button
                $('#operation-management-button').hide();
            }
        } else {
            // If no role is selected, clear the checkbox states
            $('#access_config_is_admin_site_enabled').prop('checked', false);
            $('#access_config_is_settings_site_enabled').prop('checked', false);
            $('#access_config_is_operation_site_enabled').prop('checked', false);
            $('#access_config_is_audit_site_enabled').prop('checked', false);
            $('#access_config_user_count').html('');

            // Hide the "Operation Management" button if no role is selected
            $('#operation-management-button').hide();
            // Hide the Audit Trail button if no role is selected
            $('#audit-button').hide();
        }
    }

    function toggleSubCards(isSettingsEnabled) {
        // Show/hide sub-cards based on the "Settings" checkbox state
        if (isSettingsEnabled) {
            $('.settings-sub-card').show();
        } else {
            $('.settings-sub-card').hide();
        }
    }

    // Initially display permissions for the default selected role
    displayRolePermissions();

    $('#access_config_role').on('change', function () {
        displayRolePermissions();

        // Fetch and update user count when a role is selected
        const selectedRoleId = $(this).val();
        if (selectedRoleId) {
            $.ajax({
                type: 'GET',
                url: `/roles/checkUsers/${selectedRoleId}`,
                success: function (response) {
                    const userCount = response.userCount;
                    $('#access_config_user_count').html(`( ${userCount} Users)`);
                },
                error: function () {
                    alert('Error fetching user count for the role.');
                }
            });
        }
    });

    $('#create-new-role').hide();

    $('#access_config_add_button').on('click', function () {
        $('#access_config_is_admin_site_enabled').prop('checked', false);
        $('#access_config_is_settings_site_enabled').prop('checked', false);
        $('#access_config_is_operation_site_enabled').prop('checked', false);
        $('#access_config_is_audit_site_enabled').prop('checked', false);

        // Hide the sub-cards by default
        toggleSubCards(false);

        $('#newRole').removeClass('d-none');
        //$('#chooseRole').addClass('d-none');
        $('#chooseRole1').hide();
        $('#access_config_cancel_button').removeClass('d-none');
        $('#create-new-role').show();
        $('#access_config_save_button').hide();

        // Hide the "Audit Trail" and "Operation Management" buttons in the side navbar
        $('#audit-button').hide();
        $('#operation-management-button').hide();
    });

    $('#access_config_delete_button').on('click', function () {
        const selectedRoleId = $('#access_config_role').val();

        if (selectedRoleId) {
            // Check if there are users with the selected role
            $.ajax({
                type: 'GET',
                url: `/roles/checkUsers/${selectedRoleId}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.userCount > 0) {
                        // Users exist, show error message
                        alert('Cannot delete role with active users.');
                    } else {
                        // No users, proceed with deletion
                        if (confirm('Are you sure you want to delete this role?')) {
                            deleteRole(selectedRoleId);
                        }
                    }
                },
                error: function () {
                    alert('Error checking users for the role.');
                }
            });
        } else {
            alert('Please select a role to delete.');
        }
    });

    function deleteRole(roleId) {
        // Send a DELETE request to delete the role
        $.ajax({
            type: 'DELETE',
            url: `/roles/${roleId}`,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                // Role deleted, you may want to refresh the page or update the UI
                alert('Role deleted successfully.');

                // Remove the deleted role from the dropdown
                $('#access_config_role option[value="' + roleId + '"]').remove();

                // Select the previous role
                const newSelectedRoleId = $('#access_config_role option').eq(Math.max(0, 0 - 1)).val();
                $('#access_config_role').val(newSelectedRoleId).trigger('change');
            },

            error: function () {
                alert('Error deleting role.');
            }
        });
    }
});

$('#access_config_duplicate_button').off('click');
$('#access_config_duplicate_button').on('click', function () {
    $('#newRole').removeClass('d-none');
    $('#chooseRole1').addClass('d-none');
    currentAccessConfigId = '';
    $('#access_config_id').val('');
    $('#access_config_cancel_button').removeClass('d-none');
    $('#create-new-role').show().html("Create Duplicate Role");
    // Set the value of the input field to the selected role name with '-Copy'
    const selectedRoleName = $('#access_config_role option:selected').text();
    $('#access_config_new_role').val(selectedRoleName.trim() + '-Copy');
    $('#access_config_save_button').hide();
});

// Updated cancel button handling
$('#access_config_cancel_button').on('click', function () {
    if ($('#create-new-role').is(':visible')) {
        // If in the duplicate role section
        $('#chooseRole1').show();
        $('#newRole').addClass('d-none');
        $('#access_config_cancel_button').addClass('d-none');
        $('#create-new-role').hide();
        $('#access_config_save_button').show().html('Update Role');
    } else {
        // If in the new role section
        $('#chooseRole1').show();
        $('#newRole').addClass('d-none');
        $('#access_config_cancel_button').addClass('d-none');
        $('#create-new-role').hide();
        $('#access_config_save_button').show().html('Update Role');
    }
});

// Handle form submission
$('#access_config_is_admin_site_enabled').on('change', function () {
    const isAdminEnabled = $('#access_config_is_admin_site_enabled').prop('checked') ? 1 : 0;
    // Update the hidden input value
    $('input[name="is_admin_enabled"]').val(isAdminEnabled);
    $('#formID').submit();
});

$('#access_config_is_settings_site_enabled').on('change', function () {
    const isSettingsEnabled = $('#access_config_is_settings_site_enabled').prop('checked') ? 1 : 0;
    // Update the hidden input value
    $('input[name="is_settings_enabled"]').val(isSettingsEnabled);

    // Show/hide the sub-cards based on the "Settings" checkbox state
    $('.settings-sub-card').toggle(isSettingsEnabled);

    $('#formID').submit();
});

$('#access_config_is_operation_site_enabled').on('change', function () {
    const isOperationEnabled = $('#access_config_is_operation_site_enabled').prop('checked') ? 1 : 0;
    // Update the hidden input value
    $('input[name="is_operation_enabled"]').val(isOperationEnabled);

    // Show/hide the "Operation Management" button based on the checkbox state
    $('#operation-management-button').toggle(isOperationEnabled);
    $('#formID').submit();
});

$('#access_config_is_audit_site_enabled').on('change', function () {
    const isAuditEnabled = $('#access_config_is_audit_site_enabled').prop('checked') ? 1 : 0;
    // Update the hidden input value
    $('input[name="is_audit_enabled"]').val(isAuditEnabled);

    // Show/hide the "Operation Management" button based on the checkbox state
    $('#audit-button').toggle(isAuditEnabled);
    $('#formID').submit();
});