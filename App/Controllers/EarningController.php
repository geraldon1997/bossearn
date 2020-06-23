<?php
namespace App\Controllers;

use App\Models\Bank;
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

                $bank = Bank::findBank('user_id', $uid);
                if (!empty($bank)) {
                    $bn = $bank[0]['bank'];
                    $ban = $bank[0]['acct_name'];
                    $bacn = $bank[0]['acct_num'];
                }
                

                // $total = Earning::earnings($uid)[0];
                // $t = number_format($total['totalearnings']);
                // $tc = number_format($total['totalearnings'] / 10);

                echo "<tr>
                        <td>".$sn++."</td>
                        <td>$em</td>";
                        
                        if (empty($bn) || empty($ban) || empty($bacn)) {
                            echo "
                                    <td>NULL</td>
                                    <td>NULL</td>
                                    <td>NULL</td>
                                ";
                        } else {
                            echo "  
                                    <td>$bn</td>
                                    <td>$ban</td>
                                    <td>$bacn</td>
                                ";
                        }
                        

                echo    "<td>".number_format($bref)."</td>
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
                            echo "<td>
                                    <form method='post'>
                                        <input type='hidden' name='type' value='$wt'>
                                        <input type='hidden' name='uid' value='$uid'>
                                        <button type='submit' class='btn'>paid</button>
                                    </form>
                                </td>";
                        } elseif ($wt === 'bearn') {
                            echo "<td>
                                    <form method='post'>
                                        <input type='hidden' name='type' value='$wt'>
                                        <input type='hidden' name='uid' value='$uid'>
                                        <button type='submit' class='btn'>paid</button>
                                    </form>
                                </td>";
                        } else {
                            echo "<td>pending</td>";
                        }
                echo "</tr>";
            }
        }
    }
}