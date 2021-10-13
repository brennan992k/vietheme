<p>&nbsp;</p>

<table style="background-color:#00000;" width="100%; " >
    <tr>
        <td>
            <table style="border: 1px solid #f1f1f1; border-collapse: collapse;" border="0" max-width="600" align="center" bgcolor="#fff">
                <tbody >
                    <td style="background-color: #a235ec;padding: 50px 0; color: #000 ; text-align: center; width:900px;">
                        <!-- <img style="display: inline-block;" src="img/Logo.png" alt="" /> -->
                    <h1 style="color:#f1f1f1;text-align: center"> {{str_replace('_', ' ',config('app.name') ) }}</h1>
                        {{-- <p style="font-style: italic;text-align: center"><font color="white">Digital market place</font></p> --}}
                    </td>
                    <tr>
                        <td style="padding: 50px 10px 20px 10px; color: #000000; font-family: 'Quicksand', sans-serif; font-size: 16px; line-height: 20px; text-align: center; line-height: 26px;">
                        <b>Hello, {{ @$data['to_name'] }}</b>
                            <br />
                            <p>
                                Welcome to {{ @$data['site_name'] }}
                                <br />
                                {!! @$data['message'] !!}
                            </p>
                        </td>
                    </tr>
                    <tr style="font-family: 'Quicksand', sans-serif;">
                        <td style="padding: 20px 30px 50px 40px; color: #000000; font-family: 'Quicksand', sans-serif; font-size: 16px; line-height: 20px; text-align: center; line-height: 26px;">                           
                            
                                {{-- If you did not make this request, please do not confirm the registration! --}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>