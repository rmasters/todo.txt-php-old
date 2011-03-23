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
 * TodoTxt file manager, loader and writer.
 */
class TodoTxt
{
    const EOL = "\n";

    const TODO_FILE = "todo.txt";
    const DONE_FILE = "done.txt";
    const RECUR_FILE = "recur.txt";
    const REPORT_FILE = "report.txt";
    const TODO_BACKUP = "todo.bak";
    const DONE_BACKUP = "done.bak";

    private $todoDir;
    private $autoArchive = true;
    private $tasks;
    private $files = array();

    public function __construct($todoDir) {
        $this->tasks = new ArrayObject;
        $this->todoDir = $todoDir;
        
        $this->setFiles($this->todoDir);
        
    }

    /**
     * Set the path to each file
     */
    private function setFiles($dir) {
        if (!is_dir($dir)) {
            throw new Exception(sprintf("Cannot open todo directory %s", 
                $dir));
        }

        $this->files[self::TODO_FILE] = "$dir/" . self::TODO_FILE;
        $this->files[self::DONE_FILE] = "$dir/" . self::DONE_FILE;
        $this->files[self::RECUR_FILE] = "$dir/" . self::RECUR_FILE;
        $this->files[self::REPORT_FILE] = "$dir/" . self::REPORT_FILE;
        $this->files[self::TODO_BACKUP] = "$dir/" . self::TODO_BACKUP;
        $this->files[self::DONE_BACKUP] = "$dir/" . self::DONE_BACKUP;
    }

    /**
     * Read a file into lines
     */
    private function getLines($file) {
        $lines = explode(PHP_EOL, file_get_contents($file));

        $array = array();
        $count = 1;
        foreach ($lines as $line) {
            if (strlen(trim($line)) == 0) {
                continue;
            }
            $count++;
            $array[$count] = rtrim($line);
        }

        return $array;
    }

    /**
     * Get tasks from the todo file as a TaskList
     */
    public function getTasks() {
        return new TaskList($this->getTaskLines());
    }

    /**
     * Get tasks from the todo file
     */
    public function getTaskLines() {
        return $this->getLines($this->files[self::TODO_FILE]);
    }

    /**
     * Get completed tasks
     */
    public function getDone() {
        return $this->getLines($this->files[self::DONE_FILE]);
    }

    /**
     * Write out lines
     */
    private function writeLines(array $lines, $file, $backupFile) {
        $keys = array_keys($lines);
        sort($keys);

        // Backup
        $this->backup($file, $backupFile);

        // Write out the files
        $fh = fopen($file, "w");
        foreach ($keys as $key) {
            fwrite($tasks[$key] . PHP_EOL);
        }
        fclose($fh);
        
    }

    /**
     * Write out the tasks
     */
    public function writeTasks($tasks) {
        $this->writeLines($tasks, $this->files[self::TODO_FILE], 
            $this->files[self::TODO_BACKUP]);
    }

    /**
     * Write out the completed tasks
     */
    public function writeDone($tasks) {
        $this->writeLines($tasks, $this->files[self::DONE_FILE], 
            $this->files[self::DONE_BACKUP]);
    }
 
}
