# Ross's PHP implementation of todo.txt
This is a PHP implementation of [Gina Trapani's][1] [todo.txt][2]. It is
loosely based around [Tertius Lydgate's][3] [Python implementation][4] and will
include:

* Three classes:
  * `TodoTxt` - handles todo files, loading them and writing them,
  * `TaskList` - handles sorting tasks and keeping track of projects and
    contexts,
  * `Task` - deals with parsing individual task lines;
* a PHP CLI implementation;
* and a page that retrieves a todo.txt directory from Dropbox and displays
  statistics from it.

Check out TODO.markdown for the roadmap.

[1]: https://github.com/ginatrapani
[2]: https://github.com/ginatrapani/todo.txt-cli
[3]: https://github.com/lydgate
[4]: https://github.com/lydgate/git-todo-py
