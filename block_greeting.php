<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Block greeting.
 *
 * @package    block_greeting
 * @copyright  2026 Ádrian Felipe de Amorim Oliveira
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Block greeting definition.
 */
class block_greeting extends block_base {
    // Moodle's block_base declares no init() of its own — #[\Override] would fatal
    // (PHP 8.3+ requires a real parent method to override; there isn't one here).
    /**
     * Set the block title.
     */
    public function init(): void {
        $this->title = get_string('pluginname', 'block_greeting');
    }

    #[\Override]
    public function get_content(): ?stdClass {
        if ($this->content !== null) {
            return $this->content;
        }

        global $OUTPUT;

        $message = \block_greeting\local\greeting_text::get_message();
        $this->content = new stdClass();
        $this->content->text = $OUTPUT->render_from_template('block_greeting/content', ['greeting' => $message]);
        $this->page->requires->js_call_amd('block_greeting/greeting', 'init');
        $this->content->footer = '';
        return $this->content;
    }
}
