<?php

namespace App\Mcp\Tools\Quests;

use App\Actions\Archivist\Quests\UpdateQuest;
use App\Mcp\Tools\Tool;
use Laravel\Mcp\Server\Attributes\Description;
use Laravel\Mcp\Server\Tools\Annotations\IsDestructive;
use Laravel\Mcp\Server\Tools\Annotations\IsIdempotent;
use Laravel\Mcp\Server\Tools\Annotations\IsOpenWorld;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;

#[Description(
    'Partially update a quest. Any list you send replaces the corresponding list on the record '.
    '(objectives, progress_log, related_characters, etc). Quests do NOT participate in the '.
    'wikilinks system, so text fields are stored verbatim. For objectives, send objects with '.
    'id, text and status to preserve IDs when editing. For progress_log, send objects with '.
    'id and text to preserve IDs and session attribution; optionally set session_id to move '.
    'an entry to a session in the same campaign. Omit id for a new entry. Existing string '.
    'progress entries remain supported. Read the quest first to obtain entry IDs.'
)]
#[IsReadOnly(false)]
#[IsDestructive(false)]
#[IsIdempotent(false)]
#[IsOpenWorld(false)]
class UpdateQuestTool extends Tool
{
    protected function action(): UpdateQuest
    {
        return UpdateQuest::make();
    }
}
