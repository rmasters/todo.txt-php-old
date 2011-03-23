<?php
/**
 * TodoTxt - PHP implementation of todo.txt
 * @author  Ross Masters <ross@php.net>
 * @license http://gnu.org/licenses/gpl.html GNU General Public License v3
 * @package TodoTxt
 */

namespace TodoTxt;

/**
 * Contains information about a single Task, and handles parsing each line.
 */
class Task
{
    /**
     * Single-letter priority mode allows for setting priorities when adding a
     * task by prefixing it with a single uppercase character.
     */
    public static $singleLetterPriority = false;

    private $task;
    private $priority;
    private $contexts = array();
    private $projects = array();

    public function __construct($task) {
        $task = $this->setPriority($task);
    }

    private function setPriority($task) {
        /**
         * Try to find a single letter priority if enabled, e.g. "A Go running"
         * Replace it with the normal form for the next stage
         */
        if (self::$singleLetterPriority) {
            $priority = "/[A-Z] /";
            if (preg_match($priority, $task) == 1) {
                $newPriority = "(" . substr($task, 0, 1) . ")";
                $task = preg_replace($priority, $newPriority, $task);
            }
        }

        /**
         * Match the first (X), {X}, [X] in a task
         * @todo Should this only be at the start?
         * Ensure it is uppercase
         */
        $priority = "/[\(\[\{]([a-zA-Z])[\}\]\)]/";
        if (preg_match($priority, $task, $match) == 1) {
            $newPriority = "(" . strtoupper($match[1]) . ")";
            $task = preg_replace($priority, $newPriority, $task);
            $this->priority = strtoupper($match[1]);
        }

        return $task;
    }

}
