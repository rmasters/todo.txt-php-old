<?php
/**
 * TodoTxt - PHP implementation of todo.txt
 * @author  Ross Masters <ross@php.net>
 * @license http://gnu.org/licenses/gpl.html GNU General Public License v3
 * @package TodoTxt
 */

namespace TodoTxt;

/**
 * Contains tasks and performs operations to the whole list - e.g. sorting
 */
class TaskList
{
    public static $sortIgnoreCase = true;
    public static $numericSort = false;
    public static $childSymbol = "_";

}
