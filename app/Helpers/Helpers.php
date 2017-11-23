<?php
/**
 * @return string
 */
function getCurrentDateString(){
    return \Carbon\Carbon::now()->toDateTimeString();
}

/**
 * GetCurrentDate SQLSERVER
 * @return mixed
 */
function getCurrentDate(){
    return \Illuminate\Support\Facades\DB::raw('(SELECT CURRENT_TIMESTAMP)');
}