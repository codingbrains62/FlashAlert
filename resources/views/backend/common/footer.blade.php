<footer class="main-footer @unless(Session::has('loginId'))adity @endunless" style="text-align:center;">
    <div>
        {{-- <strong>&copy; 1979-<?php echo date("Y"); ?>  --}}

            <?php
                $currentYear = date("Y");
                $currentMonth = date("n"); // Gets the current month as a number (1-12)

                // Check if the current month is greater than or equal to June (6)
                if ($currentMonth >= 6) {
                    $currentYear += 1; // Add 1 year
                }

                echo '<strong>&copy; 1979-' . $currentYear . '</strong>';
    ?>
    <a href="https://flashalert.projects-codingbrains.com/policies" target="_blank"><strong>FlashAlertNewswire.net</strong></a>
    </div>
</footer>