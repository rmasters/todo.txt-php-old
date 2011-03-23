#!/usr/bin/php
<?php
/**
 * TodoTxt - PHP implementation of todo.txt
 * @author  Ross Masters <ross@php.net>
 * @license http://gnu.org/licenses/gpl.html GNU General Public License v3
 * @package TodoTxt
 */

$oneline = basename(__FILE__) . " [-h] action [task_number] [task_description]";
$help = <<<HELP:
Usage: $oneline

Actions:
  a|add "line"
  addm "lines" - multi-line add
  addto DEST "line" - Adds a line to an external file
  app|append ITEM# "line" - Append to a line
  archive Move all done lines to done.txt and remove blank lines
  rm|del ITEM# [TERM] - Deletes a task on line ITEM#, if TERM is specified deletes the TERM from the line.
  dp|depri ITEM#[, ITEM# ...] - Deprioritise the items given
  ls|list [TERM] - List items, optionally for a given term
  lsa|listall [TERM] - List items in todo.txt and done.txt, optionally containing a given term.
  lsc|listcon` - Lists contexts.
  lf|listfile SRC [TERM] - Lists items, optionally containing a given term, in an external file.
  lsp|listpri [PRIORITY] - Displays all tasks prioritised, optionally matching the given priority.
  lsprj|listproj` - List projects.
  mv|move ITEM# DEST [SRC] - Moves a line from source destination file to destination file within the current TODO_DIR.
  prep|prepend ITEM# "TEXT" - Prepend text to a line
  p|pri ITEM# PRIORITY - Adds or replaces a priority.
  replace ITEM# "UPDATED TEXT" - Replaces the task for the given item.
  report - Generates a report from tasks and done tasks.
HELP;
