<?php foreach($p_arrays as $p_array) {
           $pending_dategame = explode("-", $p_array['value']['game']);
           $pending_date = strtotime($pending_dategame[0]);
           $pending_h_date = date('l\, M jS', $pending_date);
           array_shift($pending_dategame);
           $pending_game = ucwords(implode(" ", $pending_dategame));
           if(!in_array($p_array['value']['game'], $prev_game_keys))  {?>
           <div class="pending">
             <table class="pending_table">
             <thead class = "pending_thead">
               <tr>
               <th colspan="2"class="pending_date"><?php echo $pending_h_date; ?></th>
             </tr>
             </thead>
             <tbody class = "pending_tbody">
               <tr class ="">
                 <td colspan="2" class="pending_game"><?php echo $pending_game;?></td>
               </tr>
               <tr>
                 <td>Winner:</td>
               <td><?php echo ucwords(str_replace("-", " ", $p_array['value']['winner']));?></td>
               </tr>
               <tr class="pending_margin">
                 <td>Margin of Victory:</td>
                 <td><?php echo $p_array['value']['margin'];?></td>
               </tr>
             </tbody>
           </table>
           </div>
           <p>hello</p>
          <?php }}?>




          <?php 

             echo 'hello';
                echo $query_pending;
          ?>