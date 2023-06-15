<?php
/** @var array<\app\Repositories\Tables\Network\NetworkTable> $networks */

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index direction">

    <div class="jumbotron text-center bg-transparent">

        <section class=" p-3 p-0 form-shadow">
            <p class="border-bottom  font-weight-bold mb-2 pt-2">
                <strong class="h5">
                    لیست بررسی شبکه
                </strong>
            </p>

            <div>
                <table class="table m-0 table-bordered rounded table-sm  table table-striped ">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="font-size-md text-center  p-1">ردیف </th>
                        <th scope="col" class="font-size-md text-center  p-1">نام </th>
                        <th scope="col" class="font-size-md text-center  p-1">ip</th>
                        <th scope="col" class="font-size-md text-center  p-1">mac آدرس</th>
                        <th scope="col" class="font-size-md text-center  p-1">وضعیت</th>
                    </tr>
                    </thead>


                    <tbody>
                    <?php foreach ($networks as $key=>$itemNetwork) {
                        ?>

                        <tr>
                            <td class="p-0 text-center font-size-md">
                                <?=$key+1?>
                            </td>

                            <td class="p-0 text-center font-size-md">
                                <?=$itemNetwork->name?>
                            </td>

                            <td class="p-0 text-center font-size-md">
                                <?php
                                if ($itemNetwork->active){
                                    ?>
                                    <a href="//<?=$itemNetwork->ip?>">
                                        <?=$itemNetwork->ip?>
                                    </a>
                                    <?php
                                }
                                else {
                                    ?>
                                    <?=$itemNetwork->ip?>
                                    <?php
                                }
                                ?>
                            </td>

                            <td class="p-0 text-center font-size-md">
                                <?=$itemNetwork->mac?>
                            </td>

                            <td class="p-0 text-center font-size-md text-white <?php if ($itemNetwork->active) echo "bg-success"; else echo "bg-danger";?>">
                                <?php
                                if ($itemNetwork->active) echo "فعال";
                                else echo "غیر فعال"
                                ?>
                            </td>
                        </tr>

                        <?php
                    }?>
                    </tbody>
                </table>


                <a href="" class="mt-2 float-right text-decoration-none  text-center btn btn-warning font-size-md  border border-dark  text-hover-white   px-2 font-weight-bold font-size-md  " >
                    بررسی شبکه
                </a>

            </div>

        </section>

    </div>


</div>
