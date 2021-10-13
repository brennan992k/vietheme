<p>&nbsp;</p>
<style>
	.button-style{
		border: 1px solid;
		padding: 5px 10px;
		margin-left: 10px;
		text-decoration:none;
		color: #fff;
		background-color: #a235ec;
	}
	.button-style:hover{
		border: 1px solid;
		padding: 5px 10px;
		margin-left: 10px;
		text-decoration:none;
		color: #000;
		background-color: #fff;
	}
</style>
<table style="background-color:#00000;" width="100%; " >
    <tr>
        <td>
            <table style="border: 1px solid #f1f1f1; border-collapse: collapse;" border="0" max-width="600" align="center" bgcolor="#fff">
                <tbody >
                    <td style="background-color: #a235ec;padding: 50px 0; color: #000 ; text-align: center">
                        <!-- <img style="display: inline-block;" src="img/Logo.png" alt="" /> -->
                        <h1 style="color:#f1f1f1;text-align: center">{{GeneralSetting()->system_name}}</h1>
                    </td>
                    <tr>
                        <td style="padding: 50px 10px 20px 10px; color: #000000; font-family: 'Quicksand', sans-serif; font-size: 16px; line-height: 20px; text-align: center; line-height: 26px;">

                            <br />
								<br />
                                <h3> {{@$data['title']}} </h3>
                                <br>
                            <p>
                                {{@$data['content']}}
                            </p>
							<p> @lang('lang.to_see_this_item') <a class="button-style" href="{{route('singleProduct',[@$data['item_title'],@$data['item_id']])}}"> @lang('lang.click_here') </a></p>
                        </td>
                    </tr>
                    <tr>
					
                </tr>
                    <tr style="font-family: 'Quicksand', sans-serif;">
                        <td style="padding: 20px 30px 50px 40px; color: #000000; font-family: 'Quicksand', sans-serif; font-size: 16px; line-height: 20px; text-align: center; line-height: 26px;">                           
                            
                               
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>

