<?php

namespace App\Enums\System;

enum PermissionsEnum: string
{
        /* User Permissions */
    case CREATE_USER = 'create-user';
    case READ_USER = 'read-user';
    case UPDATE_USER = 'update-user';
    case DELETE_USER = 'delete-user';

        /* Todo Permissions */
    case CREATE_TODO = 'create-todo';
    case READ_TODO = 'read-todo';
    case UPDATE_TODO = 'update-todo';
    case DELETE_TODO = 'delete-todo';
    case CHANGE_TODO_STATE = 'change-todo-state';

    //case READ_ROLE = 'read-role';
    //case UPDATE_ROLE = 'update-role';
    //case DELETE_ROLE = 'delete-role';
    //case READ_PERMISSION = 'read-permission';
    //case UPDATE_PERMISSION = 'update-permission';
    //case DELETE_PERMISSION = 'delete-permission';
    //case READ_USER_ROLE = 'read-user-role';
    //case UPDATE_USER_ROLE = 'update-user-role';
    //case DELETE_USER_ROLE = 'delete-user-role';
    //case READ_USER_PERMISSION = 'read-user-permission';
}
