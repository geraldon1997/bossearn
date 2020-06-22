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
                $bref = $key['bref'];
                $bearn = $key['bearn'];
                $wt = $key['withdraw'];
                $brefw = $bref / 10;
                $bearnw = $bearn / 10;

                $user = User::findUser('id', $uid)[0];
                $em = $user['email'];

                $total = Earning::earnings($uid)[0];
                $t = number_format($total['totalearnings']);
                $tc = number_format($total['totalearnings'] / 10);

                echo "<tr>
                        <td>".$sn++."</td>
                        <td>$em</td>
                        <td>".number_format($bref)."</td>
                        <td>".number_format($bearn)."</td>
                        <td>$wt</td>";

                        if ($wt === 'bref') {
                            echo "<td>".number_format($brefw)."</td>";
                        } elseif ($wt === 'bearn') {
                            echo "<td>".number_format($bearnw)."</td>";
                        } else {
                            echo "<td>0</td>";
                        }

                        if ($wt === 'bref') {
                            echo "<td>click to confirm</td>";
                        } elseif ($wt === 'bearn') {
                            echo "<td>click to confirm</td>";
                        } else {
                            echo "<td>pending</td>";
                        }
                echo "</tr>";
            }
        }
    }
}