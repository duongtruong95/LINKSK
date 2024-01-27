<?php



function total_users()
{
    global $CMSNT;
    return $CMSNT->num_rows("SELECT * FROM `users` ");
}
function total_deposit()
{
    global $CMSNT;
    return $CMSNT->get_row("SELECT SUM(`total_money`) FROM `users` ")['SUM(`total_money`)'];
}
function total_online_month()
{
    global $CMSNT;
    $total = 0; 
    foreach($CMSNT->get_list("SELECT * FROM `users` ") as $row)
    {
        if(time() - $row['time_session'] <= 2592000)
        {
            $total++;
        }
    }
    return $total; 
}
function total_online_week()
{
    global $CMSNT;
    $total = 0; 
    foreach($CMSNT->get_list("SELECT * FROM `users` ") as $row)
    {
        if(time() - $row['time_session'] <= 604800)
        {
            $total++;
        }
    }
    return $total; 
}
function total_online_today()
{
    global $CMSNT;
    $total = 0; 
    foreach($CMSNT->get_list("SELECT * FROM `users` ") as $row)
    {
        if(time() - $row['time_session'] <= 86400)
        {
            $total++;
        }
    }
    return $total; 
}
function total_online()
{
    global $CMSNT;
    $total = 0; 
    foreach($CMSNT->get_list("SELECT * FROM `users` ") as $row)
    {
        if(time() - $row['time_session'] <= 300)
        {
            $total++;
        }
    }
    return $total; 
}