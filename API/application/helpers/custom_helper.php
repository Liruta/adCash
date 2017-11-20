<?php


function query_map($query, $key = 'id')
{
    if($query->num_rows() > 0){

        $resultList = $query->result_array();
        foreach($resultList as $result){
            $results[$result[$key]] = $result;
        }
        return $results;
    }
}

function checkQuery($query)
{
    if($query->num_rows() > 0){

        $resultList = $query->result_array();

        return $resultList;
    }
}