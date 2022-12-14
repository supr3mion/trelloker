<?php

class display_boards {
    function board() {

        $KEY = $_SESSION['KEY'];
        $TOKEN = $_SESSION['TOKEN'];

        $API = new API();
        $return = $API->get_all_boards($KEY, $TOKEN);

//        var_dump($return[0]);

        foreach ($return as $board) {

            $img = $board['backgroundImageScaled'];

            if ($img == 'none') {
                $img = '../img/default.png';
                $board['backgroundTopColor'] = "#795D98";
            }
            if ($board['closed']) {
                $closed = "JA";
            } else {
                $closed = "NEE";
            }


        ?>

        <div style="background-color:<?php echo $board['backgroundTopColor']; ?>;" class="w-[90%] mx-[5%] h-28 rounded-2xl overflow-hidden  grid grid-cols-10 grid-rows-1 gap-0">
            <div class="overflow-hidden bg-[#000000]/100 col-span-2">
                <img src="<?php echo $img ?>" alt="image" class="h-28 w-full">
            </div>
            <div class="overflow-hidden bg-[#000000]/75 col-span-4">
                <p class="text-xl">&nbsp; <?php echo ucfirst($board['name']) ?></p>
                <p class="text-l">&nbsp; <?php echo "laatst gewijzigd op: ".$board['dateLastActivity'] ?></p>
                <p class="text-l">&nbsp; <?php echo "Gesloten: ".$closed; ?></p>
            </div>
        <div class="overflow-hidden py-5 flex justify-center self-center bg-[#000000]/50 col-span-2">
            <div class=" col-span-2 flex">
                <a href="<?php echo $board['url']; ?>" target="_blank" class="h-full w-full text-center group transition hover:scale-105 duration-1000">
                        <p class="text-xl ">Trello</p><i class="fa-brands fa-trello text-5xl "></i>
                </a>
            </div>
        </div>
            <form action="../server.php" method="POST" class="overflow-hidden bg-[#000000]/25 col-span-2">
                <button value="<?php echo $board['id']; ?>" name="play" type="submit" class="w-full h-full items-center">
                    <p class="text-xl">PLAY</p><i class="fa-regular fa-circle-play text-5xl" ></i>
                </button>
            </form>
        </div>

        <?php
        }
    }
}