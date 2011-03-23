* Compatibility with todo.sh
  * Flags:
    * `-h` Help
    * `-f` Force action
    * `-p`/`-c` Plain mode (no colours)
    * `-a`/`-A` Don't auto-archive on completion
    * `-n`/`-N` Don't preserve line numbers (auto remove blank lines)
    * `-t`/`-T` Prepend date on task add
    * `-v` Verbose mode (some confirmation messages)
    * `-vv` Extra verbose mode (debugging information)
    * `-V` Version, license and credits
    * `-@` Hide context names in output
    * `-+` Hide project names in output
    * `-d CONFIG_FILE` Use a config file other than ~/.todo/config
    * `-x` Disable TODOTXT_FILE_FILTER
  * Commands:
    * `a|add "line"`
    * `addm "lines"` - Multi-line add
    * `addto DEST "line"` - Adds a line to an external file
    * `app|append ITEM# "line"` - Append to a line
    * `archive` Move all done lines to done.txt and remove blank lines
    * `rm|del ITEM# [TERM]` - Deletes a task on line ITEM#, if TERM is specified
      deletes the TERM from the line.
    * `dp|depri ITEM#[, ITEM# ...]` - Deprioritise the items given
    * `ls|list [TERM]` - List items, optionally for a given term
    * `lsa|listall [TERM]` - List items in todo.txt and done.txt, optionally 
      containing a given term.
    * `lsc|listcon` - Lists contexts.
    * `lf|listfile SRC [TERM]` - Lists items, optionally containing a given 
      term, in an external file.
    * `lsp|listpri [PRIORITY]` - Displays all tasks prioritised, optionally 
      matching the given priority.
    * `lsprj|listproj` - List projects.
    * `mv|move ITEM# DEST [SRC]` - Moves a line from source destination file to 
      destination file within the current TODO_DIR.
    * `prep|prepend ITEM# "TEXT"` - Prepend text to a line
    * `p|pri ITEM# PRIORITY` - Adds or replaces a priority.
    * `replace ITEM# "UPDATED TEXT"` - Replaces the task for the given item.
    * `report` - Generates a report from tasks and done tasks.
  * Respect environment variables
  * Write matching tests
