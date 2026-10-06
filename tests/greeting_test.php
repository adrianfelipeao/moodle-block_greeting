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

namespace block_greeting;

use advanced_testcase;

/**
 * Tests for the greeting block.
 *
 * @package    block_greeting
 * @category   test
 * @copyright  2026 Ádrian Felipe de Amorim Oliveira
 * @license    https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @covers     \block_greeting
 * @covers     \block_greeting\local\greeting_text
 */
final class greeting_test extends advanced_testcase {
    /**
     * Loads the block class before the tests run.
     */
    public static function setUpBeforeClass(): void {
        require_once(__DIR__ . '/../block_greeting.php');
        parent::setUpBeforeClass();
    }

    /**
     * The block renders the configured greeting string.
     */
    public function test_greeting_is_rendered(): void {
        global $PAGE;

        $page = new \moodle_page();
        $page->set_context(\context_system::instance());
        $PAGE = $page;

        $block = new \block_greeting();
        $block->page = $page;
        $content = $block->get_content();

        $this->assertNotNull($content);
        $this->assertStringContainsString(
            get_string('greeting', 'block_greeting'),
            $content->text
        );
    }
}
