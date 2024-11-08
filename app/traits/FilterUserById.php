<?php


class FilterUserById
{
    public static function booted()
    {
        self::parent();

        self::addGlobalScope(function ($query) {
            $query->where('user_id', auth()->id());
        });
    }
}
