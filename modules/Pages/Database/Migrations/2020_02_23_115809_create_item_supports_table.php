<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_supports', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->text('sort_description')->nullable();
            $table->text('long_description')->nullable();
            $table->timestamps();
        });

        DB::table('item_supports')->insert(
            [
                'description'   =>'<p>Item support includes</p>

                <ul>
                    <li>
                    <p>Not All Blank Cassettes Are Created Equal</p>
                    </li>
                    <li>
                    <p>How To Protect Your Computer Wery Useful Tips</p>
                    </li>
                    <li>
                    <p>Help Finding Information Online</p>
                    </li>
                    <li>
                    <p>Video Games Playing With Imagination</p>
                    </li>
                    <li>
                    <p>5 Reasons To Choose A Notebook Over A Computer</p>
                    </li>
                    <li>
                    <p>Fta Keys</p>
                    </li>
                    <li>
                    <p>3 Simple Ways To Save A Bunch Of Money When Buying</p>
                    </li>
                    <li>
                    <p>Pos Hardware More Options In Less Space</p>
                    </li>
                </ul>',
            
                'sort_description'   =>'<p>However, item support does not include</p>

                <ul>
                    <li>
                    <p>Not All Blank Cassettes Are Created Equal</p>
                    </li>
                    <li>
                    <p>How To Protect Your Computer Wery Useful Tips</p>
                    </li>
                    <li>
                    <p>Help Finding Information Online</p>
                    </li>
                    <li>
                    <p>Video Games Playing With Imagination</p>
                    </li>
                </ul>',


                'long_description'   =>'<ul>
                <li>
                <p>Quality checked by Infix</p>
                </li>
                <li>
                <p>Future Updates</p>
                </li>
                <li>
                <p>Theme hosting offer</p>
                </li>
                <li>
                <p>Q6 months support from Codethemes<br />
                <a href="#">What does support include</a></p>
                </li>
            </ul>',

                ]);



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_supports');
    }
}
