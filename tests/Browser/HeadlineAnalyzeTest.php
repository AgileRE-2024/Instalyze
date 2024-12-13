<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HeadlineAnalyzeTest extends DuskTestCase
{
    /**
     * A Dusk test to verify the headline analyze form and result display.
     */
    public function testHeadlineAnalyzeForm()
    {
        $inputHeadline = 'IKN Menjadi Ibu Kota Negara'; // Headline to test

        $this->browse(function (Browser $browser) use ($inputHeadline) {
            $browser->visit('http://127.0.0.1:8000')
                ->assertAttribute('@headline-input', 'placeholder', 'Enter headline')
                ->waitFor('@headline-input')
                ->type('@headline-input', $inputHeadline)
                ->press('@headline-analyze-button')
                ->waitForText($inputHeadline)
                ->assertSee($inputHeadline)
                ->waitFor('#word_count')
                ->assertSee($browser->text('#word_count'))
                ->waitFor('#char_count')
                ->assertSee($browser->text('#char_count'))
                ->waitFor('#reading_grade_level')
                ->assertSee($browser->text('#reading_grade_level'))
                ->waitFor('#reading_grade_explanation')
                ->assertSee($browser->text('#reading_grade_explanation'))
                ->waitFor('#word_recommendation')
                ->assertSee($browser->text('#word_recommendation'))
                ->waitFor('#char_recommendation')
                ->assertSee($browser->text('#char_recommendation'))
                ->waitFor('#sentiment')
                ->assertSee($browser->text('#sentiment'))
                ->waitFor('#sentiment_suggestion')
                ->assertSee($browser->text('#sentiment_suggestion'))
                ->waitFor('#clarity_analysis')
                ->assertSee($browser->text('#clarity_analysis'))
                ->waitFor('#headline_score')
                ->assertSee($browser->text('#headline_score'));
        });
    }
}