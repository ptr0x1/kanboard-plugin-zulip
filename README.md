Zulip plugin for Kanboard
=========================

Receive Kanboard notifications on [Zulip](https://zulipchat.com/).

You can configure Zulip notifications for a project or for each individual Kanboard user.

Author
------

- Frédéric Guillot (for cloning the original Mattermost plugin)
- Peter Fejer
- License MIT

Requirements
------------

- Kanboard >= 1.0.37
- Zulip

Installation
------------

You have the choice between 3 methods:

1. Install the plugin from the Kanboard plugin manager in one click
2. Download the zip file and decompress everything under the directory `plugins/Zulip`
3. Clone this repository into the folder `plugins/Zulip`

Note: Plugin folder is case-sensitive.

Configuration
-------------

### Zulip configuration

- Generate a new incoming webhook bot on Zulip (Settings > Your bots)
- Copy the bot name and API key

### Kanboard configuration

#### Individual notifications

1. Copy and paste the bot name and API key into **Integrations > Zulip** in your
   user profile
2. Set the channel and subject name that should be used
2. Enable Zulip notifications in your user profile or project settings
3. Enjoy!

#### Project notification

1. Copy and paste the webhook url into **Integrations > Zulip** in the
   project settings
2. Add the channel name (Optional)
3. Enable Zulip notification in the project
4. Enjoy!

#### Adding event filters

You might want to filter down the events that trigger a push. You use the optional filter entry for this.
If no filter is added then every event will trigger a push notification. If you add one (or more) events then ONLY those events will trigger the notification.

To use them, add the filters separated with a comma for example: task.create,task.move.column

The following events can be added to the filter:

* *task.move.column* - Move a task to another column
* *task.update* - Task modification
* *task.create* - Task creation
* *task.open* - Reopen a task
* *task.close* - Closing a task
* *task.assignee_change* - Task assignee change
* *task.move.swimlane* - Move a task to another swimlane
