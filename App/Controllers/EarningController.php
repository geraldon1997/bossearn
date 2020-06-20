<?php
namespace App\Controllers;

use App\Models\Earning;
use App\Models\User;

class EarningController extends Earning
{
    public static function view()
    {
        $earning = Earning::all();

        if (!empty($earning)) {
            $sn = 1;
            foreach ($earning as $key) {
                $uid = $key['user_id'];
                $bref = number_format($key['bref']);
                $bearn = number_format($key['bearn']);

                $user = User::findUser('id', $uid)[0];
                $em = $user['email'];

                $total = Earning::earnings($uid)[0];
                $t = number_format($total['totalearnings']);
                $tc = number_format($total['totalearnings'] / 10);

                echo "<tr>
                        <td>".$sn++."</td>
                        <td>$em</td>
                        <td>$bref</td>
                        <td>$bearn</td>
                        <td>$t</td>
                        <td>$tc</td>
                        <td>pending</td>
                </tr>";
            }
        }
    }
}