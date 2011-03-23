<?php
/**
 * TodoTxt - PHP implementation of todo.txt
 * @author  Ross Masters <ross@php.net>
 * @license http://gnu.org/licenses/gpl.html GNU General Public License v3
 * @package TodoTxt
 */

namespace TodoTxt;

use \ArrayObject;
use \Exception;

/**
 * Contains tasks and performs operations to the whole list - e.g. sorting
 */
class TaskList implements \ArrayAccess, \Iterator
{
    public static $sortIgnoreCase = true;
    public static $numericSort = false;
    public static $childSymbol = "_";

    protected $tasks;
    private $position;

    public function __construct(array $lines = null) {
        $this->tasks = new ArrayObject;

        if (is_array($lines)) {
            foreach ($lines as $line) {
                $this->tasks->append(new Task($line));
            }
        }
    }

    public function offsetExists($index) {
        return isset($this->tasks[$index]);
    }

    public function offsetGet($index) {
        return $this->tasks[$index];
    }

    public function offsetSet($index, $task) {
        if (!$task instanceof Task) {
            $task = new Task($task);
        }
        $this->tasks[$index] = $tasks;
    }

    public function offsetUnset($index) {
        unset($this->tasks[$index]);
    }

    public function current() {
        return $this->tasks[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        $this->position++;
    }

    public function rewind() {
        $this->position = 1;
    }

    public function valid() {
        return isset($this[$this->position]);
    }

    public function getArrayCopy() {
        return $this->tasks->getArrayCopy();
    }
}
