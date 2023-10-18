<?php

namespace App\Functions;

use App\Models\DesignationHasPermission;
use App\Models\Permission;
use ArrayObject;

class AccessFn
{

    public function name()
    {
        $name = new ArrayObject(array(), ArrayObject::ARRAY_AS_PROPS);
        $rows = Permission::all();
        foreach ($rows as $row) {
            $name->{strtoupper($row->name)} = $row->id;
        }

        return $name;
    }

    public function __create__($designation, $permission)
    {
        DesignationHasPermission::create([
            'designation' => $designation,
            'permission' => $permission,
        ]);
    }

    public function __destroy__($designation, $permission)
    {
        DesignationHasPermission::where(
            'designation',
            $designation
        )->where(
            'permission',
            $permission
        )->delete();
    }

    public function __has__($designation, $permission)
    {
        $row = DesignationHasPermission::where(
            'designation',
            $designation
        )->where(
            'permission',
            $permission
        )->get();

        return count($row) ? true : false;
    }

    public function include($designation, ...$permissions)
    {
        $allow = [];
        foreach ($permissions as $permission) {
            array_push($allow, AccessFn::__has__($designation, $permission));
        }
        return !in_array(false, $allow) ? true : false;
    }

    public function compose($designation, ...$permissions)
    {
        $allow = [];
        foreach ($permissions as $permission) {
            array_push($allow, AccessFn::__has__($designation, $permission));
        }
        return in_array(true, $allow) ? true : false;
    }

    public function permit($designation, ...$permissions)
    {
        foreach ($permissions as $permission) {
            if (!AccessFn::__has__($designation, $permission))
                AccessFn::__create__($designation, $permission);
        }
    }

    public function revoke($designation, ...$permissions)
    {
        foreach ($permissions as $permission) {
            AccessFn::__destroy__($designation, $permission);
        }
    }

    public function sync($designation, ...$permissions)
    {
        DesignationHasPermission::where('designation', $designation)->delete();

        foreach ($permissions as $permission) {
            AccessFn::__create__($designation, $permission);
        }
    }

    public function super($designation)
    {
        $values = array_values(json_decode(json_encode(AccessFn::name(), true), true));
        AccessFn::permit($designation, ...$values);
    }

    public function block($designation)
    {
        $values = array_values(json_decode(json_encode(AccessFn::name(), true), true));
        AccessFn::revoke($designation, ...$values);
    }
}
