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
    private $completed = false;

    public function __construct($task) {
        $task = $this->setPriority($task);
        $this->setCompleted($task);
        $this->setContexts($task);
        $this->setProjects($task);

        $this->task = $task;
    }

    public function getPriority() {
        return $this->priority;
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

    /**
     * Get the date the task was completed, or false if it has not been yet.
     * @return false|DateTime
     */
    public function getCompleted() {
        return $this->completed;
    }

    private function setCompleted($task) {
        /**
         * Completed tasks are prefixed with an "x" and the date they were 
         * completed on.
         */
        $completed = "/x ([0-9]{4}-[0-9]{2}-[0-9]{2})/";
        if (preg_match($completed, $task, $match) == 1) {
            $this->completed = new DateTime($match[1]);
        }
    }

    public function getContexts() {
        return $this->contexts;
    }

    private function setContexts($task) {
        /**
         * Contexts are given by @context
         */
        $context = "/@(.+)/";
        if (preg_match_all($context, $task, $matches) > 0) {
            foreach ($matches[1] as $match) {
                $match = trim($match);
                if (!in_array($match, $this->contexts)) {
                    $this->contexts[] = $match;
                }
            }
        }
    }

    public function getProjects() {
        return $this->projects;
    }

    private function setProjects($task) {
        /**
         * Projects are designated by +project
         */
        $project = "/\+(.+)/";
        if (preg_match_all($project, $task, $matches) > 0) {
            foreach ($matches[1] as $match) {
                $match = trim($match);
                if (!in_array($match, $this->projects)) {
                    $this->projects[] = $match;
                }
            }
        }
    }

    public function getTask() {
        return $this->task;
    }
}
