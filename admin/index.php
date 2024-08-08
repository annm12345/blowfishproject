<?php
require('top.php');
?>

        <main>
            <div class="header">
                <div class="left">
                    <h1>Dashboard</h1>
                    
                </div>
                <!-- <a href="#" class="report">
                    <i class='bx bx-cloud-download'></i>
                    <span>Download CSV</span>
                </a> -->
            </div>

            <!-- Insights -->
            <ul class="insights">
                <li>
                    <i class='bx bx-calendar-check'></i>
                    <span class="info">
                    <?php
                                $tax_res=mysqli_query($con,"SELECT * FROM `tax_payer_data` order by id desc");
                               $count=mysqli_num_rows($tax_res);
                            ?>
                        <h3>
                            <?php echo $count ?>
                        </h3>
                        
                        <p>အခွန်ထမ်းမှတ်ပုံတင်သူဦးရေ</p>
                    </span>
                </li>
                <style>
                    /* Styles for the popup container */
                    .popup-container {
                        display: none;
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        background-color: white;
                        padding: 20px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                        z-index: 9999;
                    }

                    /* Styles for the close button */
                    .popup-close {
                        position: absolute;
                        top: 10px;
                        right: 10px;
                        cursor: pointer;
                    }

                    /* Styles for the overlay background */
                    .overlay {
                        display: none;
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.5);
                        z-index: 9998;
                    }
                    #tablePopup table {
                        width:100%;
                        border-collapse: collapse;
                    }
                    #tablePopup table tr th,#tablePopup table tr td{
                        padding:1rem;
                        border:1px solid #000;
                        
                    }
                    
                </style>
                <li id="show-list"><i class='bx bx-show-alt'></i>
                <span class="info" >
                    <?php
                    $totalAdvanceSum = 0;
                    $tax_res = mysqli_query($con, "SELECT * FROM `tax_payer_data`");
                    while($tax_row = mysqli_fetch_assoc($tax_res)){
                        $taxpayer = $tax_row['taxpayer'];
                        $business_income=$tax_row['business_income'];
                        if($taxpayer=='Salary income tax'){
                            if($business_income<2000001){
                            $total_advanced=0;
                            }else if($business_income<5000001){
                            $total_advanced=$business_income/100*5;
                            }else if($business_income<10000001){
                            $total_advanced=$business_income/100*10;
                            }else if($business_income<20000001){
                            $total_advanced=$business_income/100*15;
                            }else if($business_income<30000001){
                            $total_advanced=$business_income/100*20;
                            }else{
                            $total_advanced=$business_income/100*25;
                            }
                        }else if($taxpayer=='Commercial tax'){
                        $total_advanced=$business_income/100*5;
                        }else if($taxpayer=='Buildings'){
                        $total_advanced=$business_income/100*3;
                        }else if($taxpayer=='Gold /jewelry'){
                        $total_advanced=$business_income/100*1;
                        }else if($taxpayer=='Personal professional Job'){
                        if($business_income<2000001){
                            $total_advanced=0;
                        }else if($business_income<5000001){
                            $total_advanced=$business_income/100*5;
                        }else if($business_income<10000001){
                            $total_advanced=$business_income/100*10;
                        }else if($business_income<20000001){
                            $total_advanced=$business_income/100*15;
                        }else if($business_income<30000001){
                            $total_advanced=$business_income/100*20;
                        }else{
                            $total_advanced=$business_income/100*25;
                        }
                        }
                        $totalAdvanceSum += $total_advanced;
                    }
                    ?>
                    <h3>
                        <?php echo $totalAdvanceSum ?>
                    </h3>
                    <p>အခွန်ငွေစုစုပေါင်း</p>
                </span>
                </li>

                <div class="popup-container" id="tablePopup">
                    <span class="popup-close" onclick="closePopup('tablePopup')">&times;</span>
                    <h2>တစ်ဦးချင်းပေးဆောင်ရမည့် အခွန်ငွေ</h2>
                    <table>
                        <!-- Add your table content here -->
                        <tr>
                            <th>အမည်</th>
                            <th>ပေးဆောင်ရမည့်အခွန်ငွေ</th>
                            <!-- Add more headers if needed -->
                        </tr>
                        <?php
                        $tax_table_res = mysqli_query($con, "SELECT * FROM `tax_payer_data`");
                        while($tax_table_row = mysqli_fetch_assoc($tax_table_res)){
                            $taxpayer = $tax_table_row['taxpayer'];
                            $business_income=$tax_table_row['business_income'];
                            if($taxpayer=='Salary income tax'){
                                if($business_income<2000001){
                                $total_advanced=0;
                                }else if($business_income<5000001){
                                $total_advanced=$business_income/100*5;
                                }else if($business_income<10000001){
                                $total_advanced=$business_income/100*10;
                                }else if($business_income<20000001){
                                $total_advanced=$business_income/100*15;
                                }else if($business_income<30000001){
                                $total_advanced=$business_income/100*20;
                                }else{
                                $total_advanced=$business_income/100*25;
                                }
                            }else if($taxpayer=='Commercial tax'){
                            $total_advanced=$business_income/100*5;
                            }else if($taxpayer=='Buildings'){
                            $total_advanced=$business_income/100*3;
                            }else if($taxpayer=='Gold /jewelry'){
                            $total_advanced=$business_income/100*1;
                            }else if($taxpayer=='Personal professional Job'){
                            if($business_income<2000001){
                                $total_advanced=0;
                            }else if($business_income<5000001){
                                $total_advanced=$business_income/100*5;
                            }else if($business_income<10000001){
                                $total_advanced=$business_income/100*10;
                            }else if($business_income<20000001){
                                $total_advanced=$business_income/100*15;
                            }else if($business_income<30000001){
                                $total_advanced=$business_income/100*20;
                            }else{
                                $total_advanced=$business_income/100*25;
                            }
                            }
                            ?>
                        <tr>
                            <td><?php echo $tax_table_row['company_name'] ?></td>
                            <td><?php echo $total_advanced ?></td>
                            <!-- Add more data cells if needed -->
                        </tr>
                        <?php } ?>
                    </table>
                </div>

                <!-- Overlay background -->
                <div class="overlay" id="overlay" onclick="closePopup('tablePopup')"></div>

                <script>
                    // Function to show the popup and overlay
                    function showPopup(popupId) {
                        document.getElementById(popupId).style.display = 'block';
                        document.getElementById('overlay').style.display = 'block';
                    }

                    // Function to close the popup and overlay
                    function closePopup(popupId) {
                        document.getElementById(popupId).style.display = 'none';
                        document.getElementById('overlay').style.display = 'none';
                    }

                    // Event listener for the "show-list" element
                    document.getElementById('show-list').addEventListener('click', function() {
                        showPopup('tablePopup');
                    });
                </script>
                <!-- <li><i class='bx bx-line-chart'></i>
                    <span class="info">
                        <h3>
                            14,721
                        </h3>
                        <p>Searches</p>
                    </span>
                </li>
                <li><i class='bx bx-dollar-circle'></i>
                    <span class="info">
                        <h3>
                            $6,742
                        </h3>
                        <p>Total Sales</p>
                    </span>
                </li> -->
            </ul>
            <!-- End of Insights -->

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>ယနေ့အခွန်ထမ်းမှတ်ပုံတင်သူစာရင်း</h3>
                        <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i>
                        <input type="text" id="message-search" placeholder="Search by product name" style="padding:0.2rem;outline:none;border-radius:5px;border:0.5px solid gray">

                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Tax form ID</th>
                                <th>User</th>
                                <th>Order Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="data">
                            <?php
                                $tax_res=mysqli_query($con,"SELECT * FROM `tax_payer_data` order by id desc");
                                while($tax_row=mysqli_fetch_assoc($tax_res)){
                            ?>
                            <tr>
                                <td id="pname"><?php echo $tax_row['id'] ?></td>
                                <td id="pname">
                                    
                                    <p><?php echo $tax_row['company_name'] ?></p>
                                </td>
                                <td id="pname"><?php echo $tax_row['date'] ?></td>
                                <td><a href="form_view.php?id=<?php echo $tax_row['id'] ?>" class="status completed">ကြည့်ရှုမည်</a></td>
                            </tr>
                            <?php }
                            ?>
                            
                        </tbody>
                    </table>
                </div>

                

            </div>

        </main>

    </div>

    <script src="index.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
            $(document).ready(function() {
            const messageSearch = $('#message-search');
            const data = $('#data tr');

            const searchMessage = () => {
                const val = messageSearch.val().toLowerCase();
                
                data.each(function() {
                    const name = $(this).find('#pname').text().toLowerCase();
                    if (name.indexOf(val) !== -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Search chat
            messageSearch.on('input', searchMessage);
        });

    </script>     
</body>

</html>