<?php
/**
 * TodoTxt - PHP implementation of todo.txt
 * @author  Ross Masters <ross@php.net>
 * @license http://gnu.org/licenses/gpl.html GNU General Public License v3
 * @package TodoTxt
 */

namespace TodoTxt;

/**
 * TodoTxt file manager, loader and writer.
 */
class TodoTxt
{
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
            throw new \Exception(sprintf("Cannot open todo directory %s", 
                $dir));
        }

        $this->files[TODO_FILE] = "$dir/" . TODO_FILE;
        $this->files[DONE_FILE] = "$dir/" . DONE_FILE;
        $this->files[RECUR_FILE] = "$dir/" . RECUR_FILE;
        $this->files[REPORT_FILE] = "$dir/" . REPORT_FILE;
        $this->files[TODO_BACKUP] = "$dir/" . TODO_BACKUP;
        $this->files[DONE_BACKUP] = "$dir/" . DONE_BACKUP;
    }

    /**
     * Read a file into lines
     */
    private function getLines($file) {
        $lines = explode(file_get_contents($file), PHP_EOL);

        $array = array();
        $count = 0;
        foreach ($lines as $line) {
            if (strlen(trim($lines[$i])) == 0) {
                continue;
            }
            $count++;
            $array[$count] = rtrim($line);
        }
    }

    /**
     * Get tasks from the todo file
     */
    public function getTasks() {
        return $this->getLines($this->files[TODO_FILE]);
    }

    /**
     * Get completed tasks
     */
    public function getDone() {
        return $this->getLines($this->files[DONE_FILE]);
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
        $this->writeLines($tasks, $this->files[TODO_FILE], 
            $this->files[TODO_BACKUP]);
    }

    /**
     * Write out the completed tasks
     */
    public function writeDone($tasks) {
        $this->writeLines($tasks, $this->files[DONE_FILE], 
            $this->files[DONE_BACKUP]);
    }
 
}
