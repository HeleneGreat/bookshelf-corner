<?php $currentPageTitle = $datas['book']['title'] . ", mon avis";
$errorMngt = "ignore this page";
include ('layouts/header.php');
?>

<!-- One book presentation -->
<section id="one-book" class="container">
    <h1><?= $datas['book']['title']; ?></h1>
    <article>
        <h2 class="italic date">Article publié le <?= $datas['book']['date']; ?> par <?= $datas['book']['pseudo'] ;?></h2>
        <div id="info-book" class="flex-md justify-center align-items-center">
            <div class="cover">
                <img src="./App/Public/Books/images/<?= $datas['book']['picture']; ?>" alt="Couverture du livre <?= $datas['book']['title']; ?>">
            </div>
            <div class="book-identity">
                <ul>
                    <li>Autheur : <span class="bold italic"><?= $datas['book']['author']; ?></span></li>
                    <li>Année de publication : <span class="bold italic"><?= $datas['book']['year_publication']; ?></span></li>
                    <li>Genre : <span class="bold italic"><?= $datas['book']['category']; ?></span></li>
                    <li>Mon avis :
                        <span id="notation" class="bold"> <?= $datas['book']['notation'];?> / 5</span>
                        <svg class="center" width="101" height="99" xmlns="http://www.w3.org/2000/svg">
                            <title/>
                            <g id="imagebot_2">
                            <!-- notation 1/5 -->
                            <g id="imagebot_89">
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" fill="#ffffff" fill-rule="evenodd" stroke="#ff6600" stroke-width="0.29055" stroke-miterlimit="4" d="M7.51301,62.19342C4.78298,66.57226 5.57343,69.63091 6.54074,72.62325L50.8233,103.02884L91.92388,85.70472L88.7419,83.5834L88.03479,80.04787C89.16615,78.95539 90.23228,77.87596 90.95161,76.86589C91.14937,75.66216 92.05909,74.10244 90.50967,73.7723L43.57545,50.79133L11.49048,60.95599L9.98788,62.3702L7.51301,62.19342z" id="imagebot_32"/>
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" clip-rule="nonzero" fill="#000000" fill-rule="evenodd" stroke-width="1.77165" stroke-miterlimit="4" stroke-dashoffset="0" d="M43.81836,49.80859L10.36133,60.10547C10.36133,60.10547 9.9391,61.18282 9.45898,61.39258C8.75856,61.69858 7.1875,61.08203 7.1875,61.08203C5.79232,61.72792 4.76459,64.53759 4.60547,67.12891C4.44635,69.72022 4.97495,72.27319 5.82813,73.22852L50.07617,104.04297C50.73859,104.41745 51.07497,104.30288 51.41211,104.18945L92.87891,87.07617C93.69952,86.70526 93.74082,85.82597 93.04492,84.87891L88.97852,82.05664C89.30628,83.53337 89.54827,84.92699 89.37695,85.73828C81.27817,88.98305 62.43551,96.61726 51.70898,101.19531C50.87452,100.03298 50.78112,98.25023 50.61719,96.67773C50.43471,94.92732 50.60809,92.58168 51.29688,91.54297C51.98569,90.50426 52.81959,91.53127 53.36328,91.27734C53.80177,91.07255 54.47669,90.60573 54.8418,90.06055C63.17389,87.27144 81.53412,79.85581 92.73047,75.49805C93.53523,74.67137 93.09412,74.15616 92.5918,73.65625L43.81836,49.80859zM43.6543,51.89063L89.26367,74.65039L53.61719,88.26367C53.61719,88.26367 53.12891,89.08008 52.69141,89.23633C52.31264,89.3716 51.73294,88.84643 51.31836,88.70313C50.80824,88.52679 49.95842,88.84955 49.59375,89.41797C48.72563,90.77115 48.20069,92.42606 47.92383,94.00391C47.59064,95.90276 47.85575,97.74772 48.35938,99.42188L8.52539,72.01367C7.61611,71.39539 6.72272,69.5544 6.8418,67.61523C6.96253,65.64911 7.44436,63.6225 8.73438,63C8.73438,63 10.19048,63.51505 10.64258,63.37891C11.15147,63.22565 11.76758,62.13477 11.76758,62.13477zM11.55327,64.46311C10.78054,64.78666 23.71445,72.34849 30.50781,76.41211C37.04947,80.32516 51.05863,88.58123 51.4707,87.92773C51.88278,87.27424 37.80637,79.49699 31.29102,75.58594C24.69647,71.62734 12.326,64.13955 11.55327,64.46311z" id="imagebot_29"/>
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" clip-rule="nonzero" fill="#000000" fill-rule="evenodd" stroke-width="1.77165" stroke-miterlimit="4" stroke-dashoffset="0" d="M91.77148,75.86914L54.87305,90.0293C54.59023,90.26473 53.78745,91.15481 53.26953,91.26367C52.66039,91.39171 52.01713,90.58525 51.25781,91.50195C50.62015,93.32215 50.54407,94.57177 50.75391,96.26953C51.02903,98.49554 51.1628,99.13059 51.89648,101.10352L89.31836,85.92383C89.83394,84.30503 89.07401,82.71402 88.83008,81.27344C88.74886,80.73732 88.76169,80.26395 89.01172,79.66602C89.26175,79.06808 90.13239,78.68181 91.05273,77.66992C91.59869,77.06966 91.71929,76.4694 91.77148,75.86914zM89.63672,77.77734C89.76643,78.48618 88.48266,78.38542 87.85742,79.17188C87.72621,79.33692 87.6259,79.52598 87.54297,79.72266C87.06616,79.88484 85.23578,80.5051 84.26172,80.86523C80.20751,82.36417 72.11813,85.43245 72.21875,85.67578C72.31937,85.91912 80.2629,82.56904 84.30664,81.25C85.34364,80.91174 86.93958,80.41595 87.37695,80.2793C87.25297,80.815 87.23504,81.32432 87.26758,81.53906C87.46623,82.85031 87.65712,83.76447 87.63672,84.68359L52.69531,99.20703C52.18612,97.97488 51.83157,96.80801 51.75781,95.55078C52.1517,95.40305 61.10182,92.04485 65.80273,90.05469C69.93306,88.30608 78.54196,85.26511 78.375,85.01758C78.20804,84.77005 69.66164,87.78368 65.54297,89.65625C61.12344,91.66561 52.81738,94.71913 51.74023,95.01758C51.74683,94.22822 51.86417,93.39822 52.14063,92.48438C52.39941,92.51726 53.38491,92.56715 53.64844,92.5254C54.23677,92.43216 54.65167,91.91979 55.24023,91.3379C56.55273,90.8379 89.63672,77.77735 89.63672,77.77735L89.63672,77.77734zM72.27344,89.4375C67.90505,91.19825 56.45792,95.98336 56.4375,96.20508C56.41708,96.4268 68.11823,91.6396 72.44336,89.87891C76.4208,88.25974 86.4172,84.54175 85.67243,84.50441C84.92765,84.46707 75.97263,87.94648 72.27344,89.4375z" id="imagebot_28"/>
                            </g>
                            <!-- notation 2/5 -->
                            <g id="imagebot_88">
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" fill="<?= $datas['book']['notation'] > 1 ? "#ffffff" : "#ee5f4f73" ;?>" fill-rule="evenodd" stroke="#ff0000" stroke-width="0.29055" stroke-miterlimit="4" d="M9.104,44.86931L12.37437,43.98542L47.19938,43.72026L86.00186,67.40834L84.41087,68.29222L82.81988,72.9768C83.27655,74.24371 83.23894,76.49919 84.32248,76.51234L35.88567,88.44476L6.89429,54.32686C7.32336,51.07184 6.13618,47.27808 9.104,44.86931z" id="imagebot_26"/>
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" clip-rule="nonzero" fill="#000000" fill-rule="evenodd" stroke-width="1.77165" stroke-miterlimit="4" stroke-dashoffset="0" d="M47.48633,42.78906L11.84766,43.13477C11.61605,43.46475 11.06294,43.95103 10.79297,44.01172C10.50906,44.07555 9.73941,43.45099 9.26758,43.63281C7.12781,44.4574 6.90852,46.9688 6.54102,48.36133C5.88028,50.86498 6.46934,54.67151 7.22266,55.80273C8.34766,57.11523 34.01462,87.50069 34.99414,88.4668C36.12556,89.58273 37.16205,89.73496 39.04883,89.24219C47.47415,87.04173 71.99301,81.70019 87.48242,77.48438C88.39591,77.00651 88.02036,76.21615 87.35156,75.58203L83.63672,73.32617C83.65396,74.34189 83.79848,75.26754 84.09766,76.2207C69.70363,79.5405 52.56006,83.27507 37.96094,86.56055C36.69102,86.11375 35.40455,84.12085 35.25781,83.08203C34.85183,80.20783 35.39305,78.84463 35.94531,78.04492C36.49529,77.24851 36.91836,76.76652 37.42188,76.45313C37.9783,76.51036 38.80126,76.74782 39.29102,76.56445C39.81001,76.37014 40.17325,75.99115 40.55469,75.63672L86.88281,68.40625C87.60261,67.86236 87.13971,67.10053 86.78125,66.77539L47.48633,42.78906zM47.06836,44.87109L83.30664,67.01563L39.44531,73.75977C38.96236,74.00638 38.79296,74.568 38.57813,74.64844C38.36329,74.72887 37.67243,74.56599 37.08984,74.50977C35.88005,74.86559 34.31316,77.05952 33.93164,78.61719C33.0591,82.17958 33.73036,84.0159 35.31445,86.55078L8.95508,54.88086C8.31849,53.91168 7.95776,52.28674 8.38086,49.64453C8.59077,48.33369 9.03476,47.06571 9.70898,45.98633C10.13534,46.01895 10.51516,46.32117 11.22656,46.0918C12.14262,45.79644 12.12666,45.09906 12.3457,45.01563zM11.86168,47.22533C11.36988,47.6732 20.09803,56.03488 24.40234,60.51563C28.75794,65.04976 36.89442,74.45194 37.54102,73.95313C38.18761,73.45431 29.54663,64.30544 25.20898,59.79297C21.01735,55.4324 12.35348,46.77746 11.86168,47.22533z" id="imagebot_23"/>
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" clip-rule="nonzero" fill="#000000" fill-rule="evenodd" stroke-width="1.77165" stroke-miterlimit="4" stroke-dashoffset="0" d="M85.62109,68.60352C70.45242,70.78255 48.54049,74.0901 40.56445,75.5918C40.24466,76.031 39.70679,76.412 39.02539,76.57031C38.7676,76.6302 38.13809,76.51025 37.42773,76.44727C35.74862,77.54053 35.03189,79.78976 35.25781,81.86719C35.54702,84.52656 36.63225,85.55074 38.0635,86.57422C53.42319,83.16678 68.78288,80.3634 84.14258,76.22461C83.03223,72.7723 84.0749,70.72989 85.62109,68.60352zM82.36328,70.50781C81.7826,71.63484 81.68707,72.3811 81.85156,73.64648C81.52598,73.70767 77.8817,74.39027 75.93164,74.77148C73.56081,75.23495 68.95068,75.90467 68.94336,76.24805C68.93606,76.59143 73.7399,75.80535 76.09375,75.31836C77.83149,74.95883 81.0695,74.56917 81.89844,73.94531C81.94242,74.23994 81.98285,74.52064 82.04883,74.88281L38.53125,85.125C37.97067,84.78531 37.48835,84.11962 37.14063,83.41406C37.88706,83.26886 44.88004,81.911 48.57031,81.33594C52.81903,80.67385 61.28106,78.84872 61.16406,78.54492C61.04707,78.24113 53.08816,80.28499 48.50195,80.76367C44.68655,81.1619 37.5519,82.64744 36.87305,82.78906C36.73995,82.415 36.64179,82.0511 36.62109,81.74219C36.51359,80.13745 36.47264,79.05342 37.87891,77.63477C38.18253,77.8818 38.8534,78.04327 39.39063,77.92773C40.17165,77.75977 40.52991,77.55853 41.01367,77.02344L82.36328,70.50781zM76.82031,73.02148C76.05391,72.88285 65.78829,74.82632 60.48633,75.66602C53.19648,76.82054 38.54472,78.73824 38.71289,79.16406C38.88106,79.58988 53.5014,77.30535 60.85156,76.08984C66.43241,75.16693 77.58672,73.16012 76.82031,73.02148z" id="imagebot_22"/>
                            </g>
                            <!-- notation 3/5 -->
                            <g id="imagebot_86">
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" fill="<?= $datas['book']['notation'] > 2 ? "#ffffff" : "#ee5f4f73" ;?>" fill-rule="evenodd" stroke="#ff6600" stroke-width="0.29055" stroke-miterlimit="4" d="M46.05033,29.66651L8.04334,35.0582C6.75801,38.37441 4.72376,41.27872 7.95495,47.07902L47.72971,77.30783L92.63099,63.96119L89.27223,62.10504C89.35315,58.62156 90.23357,55.57451 92.10066,51.85199L46.05033,29.66651z" id="imagebot_20"/>
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" clip-rule="nonzero" fill="#000000" fill-rule="evenodd" stroke-width="1.77165" stroke-miterlimit="4" stroke-dashoffset="0" d="M46.08398,29.0625L8.36914,34.07031C6.4321,34.62434 5.32655,38.85808 5.41016,41.41797C5.47555,43.42024 6.57878,46.59025 7.83203,47.97656L47.99219,78.51953L94.55078,64.99414C95.13654,64.23184 94.84953,63.81865 94.62891,63.37891L90.2461,60.71875C90.2461,60.71875 90.34961,62.63086 90.22462,63.88086C78.25487,67.02254 59.32703,72.21139 48.13477,75.36328C47.44546,74.67089 46.50593,71.99736 46.45313,70.2832C46.363,67.35726 46.80759,65.5049 47.94336,64.47852L94.73047,53.94336C95.27346,53.59152 95.33739,52.72481 94.54493,51.95898L46.08398,29.0625zM45.95703,30.67578L90.41406,52.40234L45.92383,62.30078C44.35535,64.21532 43.96185,66.31432 43.99805,68.41602C44.0283,70.1723 44.50582,72.76067 45.3457,74.13281L9.11328,46.18945C8.21466,45.37952 7.56122,42.81239 7.55859,41.66602C7.55455,39.89843 8.1583,38.15789 9.19141,35.93945zM11.17789,37.21813C10.25141,37.62299 26.10938,48.92383 26.10938,48.92383C26.10938,48.92383 44.52447,62.33497 44.74805,61.71094C44.97162,61.08691 27.41406,47.68555 27.41406,47.68555C27.41406,47.68555 12.10438,36.81327 11.17789,37.21813z" id="imagebot_17"/>
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" clip-rule="nonzero" fill="#000000" fill-rule="evenodd" stroke-width="1.77165" stroke-miterlimit="4" stroke-dashoffset="0" d="M92.5957,54.4082L90.57813,54.86133L48.45703,64.2168C47.68455,65.05046 46.38971,66.70502 46.79297,70.30273C46.99955,72.14576 47.46764,73.80218 48.5957,75.27539L90.23047,63.90039C90.40135,62.83135 90.24728,60.68778 90.38086,59.14063C90.51445,57.59347 91.01929,57.0344 91.53125,56.18164L92.5957,54.4082zM89.3125,56.63477C89.09749,57.40343 88.7766,58.1197 88.62695,58.91992C88.12128,58.9023 87.37363,58.88724 86.93555,58.97851C84.3605,59.515 79.22512,60.94199 79.375,61.23828C79.52488,61.53457 84.17874,59.84384 87.12305,59.66015C87.549,59.63358 88.10677,59.66315 88.53125,59.6914C88.49121,60.1728 88.47026,60.56566 88.45312,60.95117C83.87849,62.1035 78.78928,63.3406 74.22851,64.46289C68.35594,65.90797 59.61612,67.80532 59.72851,68.29297C59.8409,68.78061 68.57264,66.40168 74.40234,64.96679C78.9601,63.84498 83.86085,62.78021 88.43554,61.63672C88.44084,61.94764 88.45902,62.22941 88.50976,62.45312L49.67188,73.00977C48.4498,72.51899 48.44168,71.20965 48.30859,70.20508C48.1074,68.68643 48.105,66.93551 49.11133,66.12305zM67.03125,63.42773C60.62447,65.00933 48.89569,68.11308 49,68.42383C49.10431,68.73457 60.79348,65.57564 67.12305,63.85742C70.47026,62.94879 77.3336,61.2653 76.7222,61.10285C76.11081,60.9404 70.1647,62.6542 67.03125,63.42773z" id="imagebot_16"/>
                            </g>
                            <!-- notation 4/5 -->
                            <g id="imagebot_81">
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" fill="<?= $datas['book']['notation'] > 3 ? "#ffffff" : "#ee5f4f73" ;?>" fill-rule="evenodd" stroke="#ff6600" stroke-width="0.29055" stroke-miterlimit="4" d="M51.97235,18.52958L15.29118,28.95941C15.29118,28.95941 14.84924,30.37362 14.31891,30.28523C13.78858,30.19684 11.57887,30.19684 11.57887,30.19684C9.61235,32.70461 9.56854,35.08419 11.13693,37.3563L63.46283,62.98892L102.53048,48.84678L100.76272,47.34418L102.61887,44.60414L102.70727,40.27311L51.97235,18.52958z" id="imagebot_14"/>
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" clip-rule="nonzero" fill="#000000" fill-rule="evenodd" stroke-width="2.48031" stroke-miterlimit="4" stroke-dashoffset="0" d="M52.00195,17.88477C39.6699,21.31665 25.72926,25.00559 14.50586,27.96484C14.28706,28.10373 14.20689,28.64355 13.72852,29.13281C13.52004,29.34603 12.64598,28.89633 12.33594,28.93164C11.85026,28.98695 11.29017,29.39491 10.89844,29.74023C10.3642,30.21119 10.20401,30.673 9.9668,31.32813C9.72183,32.00467 9.72852,32.75762 9.67383,33.60156C9.56445,35.28945 9.87758,37.26703 10.58398,38.19531C27.90238,46.76177 46.44277,56.29728 63.01953,64.36523C63.36803,64.63506 64.14712,64.67664 64.58984,64.60156C65.03257,64.52648 65.41032,64.37843 65.54883,64.08203C65.63681,63.89376 65.89999,63.53379 66.1875,63.3457C66.48003,63.15433 66.75738,63.64035 67.41602,63.62891L103.62891,49.77344C104.03262,49.61896 104.29792,49.03333 103.63091,48.49609L101.32232,47.01172L100.16607,48.74414C89.41145,52.44005 77.26536,56.8968 65.89258,61.0625C65.02432,60.87691 64.01963,59.04768 63.9668,58.18555C63.90786,57.22386 64.39474,56.1182 64.69336,55.64258C77.31604,50.9411 91.05968,46.26926 104.7207,41.42578C105.36208,41.06421 105.17674,40.49482 104.6211,39.83398L52.00195,17.88477zM51.9414,19.48242L101.05273,40.90039L64.42187,53.52734C63.58237,53.8441 63.0628,54.52236 62.62109,55.16797C62.04657,56.00769 61.65222,57.25999 61.74414,58.75977C61.82914,60.14679 62.17413,61.08118 62.64257,61.83203L12.13281,36.81055C11.46634,35.83016 11.49357,34.93713 11.55859,33.76172C11.60974,32.8371 11.86259,32.02685 12.4043,31.3418C12.46824,31.26094 13.18907,30.71138 13.93945,31.13672C14.24986,31.31267 14.55157,31.31863 15.08008,30.93945C15.73087,30.47255 15.50385,30.04499 15.95313,29.68359L51.94141,19.48242L51.9414,19.48242zM15.63086,30.88086C15.50462,30.85723 15.42961,30.86253 15.4082,30.89649C15.06577,31.43969 29.82777,38.45988 37.14453,42.0293C45.23061,45.97404 61.34192,53.84257 61.62891,53.38868C61.91589,52.93478 45.59309,45.01679 37.45703,41.06836C30.62997,37.75519 17.52444,31.23534 15.63086,30.88086z" id="imagebot_11"/>
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" clip-rule="nonzero" fill="#000000" fill-rule="evenodd" stroke-width="1px" stroke-miterlimit="4" stroke-dashoffset="0" d="M103.46094,41.89453C90.0998,46.26502 71.6035,53.19069 64.81055,55.52734C64.04197,56.37198 64.09831,57.447 64.35352,58.4375C64.60872,59.428 65.42372,60.80617 66.01563,61.04492L100.47461,48.69531C100.73705,48.33233 101.84059,47.31047 102.57812,46.17578C102.94689,45.60844 103.23242,44.67511 103.37695,44.05664C103.52148,43.43817 103.75936,42.3411 103.46095,41.89453L103.46094,41.89453zM102.17578,43.16602C102.4311,43.97671 101.86828,44.61168 101.48633,45.23633C100.87841,46.2305 100.06951,47.22531 99.53516,47.9375L66.46875,59.79492C65.93607,59.51555 65.50814,58.90891 65.32227,58.1875C65.13145,57.44691 65.19487,56.65495 65.40821,56.31641zM84.64844,50.2168C78.90371,52.31348 67.34133,56.04749 67.50781,56.66797C67.67429,57.28845 79.16131,52.76811 84.95898,50.64453C90.41329,48.64672 100.78553,44.84938 100.57961,44.59482C100.37369,44.34026 89.81291,48.33189 84.64844,50.2168zM99.54297,46.81445C99.41767,46.65985 95.25216,48.11195 93.20312,48.89258C91.27443,49.62736 66.32212,58.55606 66.4375,58.86328C66.55288,59.1705 91.57992,50.06265 93.53125,49.32813C95.56365,48.56309 99.66826,46.96906 99.54297,46.81445z" id="imagebot_10"/>
                            </g>
                            <!-- notation 5/5 -->
                            <g id="imagebot_79">
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" fill="<?= $datas['book']['notation'] > 4 ? "#ffffff" : "#ee5f4f73" ;?>" fill-rule="evenodd" stroke="#ff6600" stroke-width="0.29055" stroke-miterlimit="4" d="M54.97755,6.42038L13.96536,14.55211C10.96647,17.45028 9.89868,21.08411 11.84404,25.86581L53.47495,53.61975L101.82338,41.42216L97.58074,38.41696L97.22718,33.82076L101.11627,28.51746L54.97755,6.42038z" id="imagebot_8"/>
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" clip-rule="nonzero" fill="#000000" fill-rule="evenodd" stroke-width="2.12598" stroke-miterlimit="4" stroke-dashoffset="0" d="M55.15234,5.85156L12.97656,14.05664C12.97656,14.05664 10.2004,17.20175 10.24414,20.43945C10.28666,23.58723 10.65725,25.45706 11.55859,26.35938C12.87239,27.27505 53.46875,54.73633 53.46875,54.73633L102.39062,41.86328C102.89512,41.24362 102.52349,40.76994 102.14844,40.29688L98.4043,38.61523L98.73047,40.32617C84.31672,44.15183 69.09629,48.10041 54.46094,51.73242C54.26191,50.88435 53.5691,48.51277 53.50391,47.68359C53.25499,44.51781 55.35987,41.6234 55.63672,41.25586L101.88086,30.30078C102.38709,29.61963 102.24258,28.71871 101.69922,28.1875L55.15234,5.85156zM55.0332,7.32227L99.03516,28.71289L54.70508,39.80078C54.70508,39.80078 51.36035,43.14549 51.65234,47.61914C51.7594,49.25941 52.62536,51.55978 52.78516,52.18359L13.23633,25.80859C12.42882,24.97037 12.17057,23.27151 12.13086,20.33203C12.10516,18.42972 13.60232,15.87038 13.82813,15.67188zM14.57031,15.92578C14.33814,16.39655 27.13092,23.98833 33.53906,27.80469C40.32233,31.84445 53.53749,40.00563 54.14453,39.49414C54.75158,38.98265 40.95278,31.0554 34.22852,27.05078C27.76137,23.19928 14.80248,15.45501 14.57031,15.92578z" id="imagebot_7"/>
                            <path transform="matrix(1 0 0 1 -4.44635 -5.85156)" clip-rule="nonzero" fill="#000000" fill-rule="evenodd" stroke-width="1px" stroke-miterlimit="4" stroke-dashoffset="0" d="M100.96875,30.19922C100.83013,30.21535 100.67975,30.2834 100.60156,30.30273L55.99023,41.16016C54.95542,42.87835 53.9244,44.57923 53.72852,46.42383C53.54451,48.15661 54.40939,50.4358 54.7207,51.96875L98.73633,40.40625C98.40171,38.69701 98.1773,37.13396 98.1582,35.74805C98.13495,34.06115 98.90838,32.81701 99.66797,31.94531C100.04776,31.50947 100.33799,31.40991 100.63672,31.19531C100.88629,31.01603 101.17613,30.87154 101.27734,30.69922C101.32474,30.61853 101.30674,30.55588 101.27534,30.40234C101.23804,30.21793 101.10801,30.18301 100.9687,30.19922L100.96875,30.19922zM97.08789,32.38672C96.41173,33.21327 96.23412,33.82457 96.19336,34.4668C93.24412,34.89713 83.82643,36.94192 78.71484,38.11133C72.7705,39.47125 60.90238,42.37401 60.99219,42.67969C61.082,42.98536 73.00139,40.19799 78.9707,38.83203C84.07231,37.66463 93.25607,35.62443 96.18359,34.76563C96.18229,35.14912 96.20133,35.55111 96.20312,36.03711C96.21092,38.15632 96.51435,38.8931 96.59766,39.27344L55.54102,49.54102C55.39958,49.16065 55.31426,48.85253 55.25,48.5625C56.12353,48.57 58.7958,48.06269 60.2207,47.71289C62.07062,47.25876 68.226,45.51889 68.19922,45.26758C68.17244,45.01627 61.88105,46.67149 59.97656,47.13867C58.57733,47.48191 56.00953,47.98584 55.20703,48.32031C55.11246,47.75114 55.1252,47.22394 55.17773,46.39648C55.30435,44.40194 56.2163,43.19821 56.36718,42.9707zM72.60742,42.08203C67.42561,43.22045 57.14577,45.29973 57.16992,45.74609C57.19407,46.19246 67.63927,43.95856 72.82031,42.82031C78.57416,41.55622 90.08457,38.8406 89.26664,38.69792C88.44872,38.55524 78.00094,40.8971 72.60742,42.08203z" id="imagebot_6"/>
                            </g>
                            </g>
                        </svg>
                        <span class="bold"><?php 
                            if($datas['book']['notation'] == 1){ echo "Passez votre chemin, vous avez mieux à faire.";}
                            elseif($datas['book']['notation'] == 2){ echo "Sans plus, ce livre ne m'a rien inspiré.";}
                            elseif($datas['book']['notation'] == 3){ echo "Un bon moment passé en compagnie de ce livre.";}
                            elseif($datas['book']['notation'] == 4){ echo "Un très bon livre, qui se dévore tout seul!";}
                            else{ echo "Un véritable coup de cœur, à lire immédiatement!!";}
                        ?></span>
                    </li>
                </ul>
            </div>
        </div>
        <div id="article-book">
            <p class="catchphrase bold"><?= $datas['book']['catchphrase']; ?></p>
            <p class="content"><?= $datas['book']['content']; ?></p>
        </div>
   </article>
</section>

<!-- Add a comment form if the user or admin is connected -->
<section id="comments" class="container">
    <h2 class="text-center">Ajouter un commentaire</h2>
    <?php if(!empty($_SESSION)){ ;?>
    <form action="index.php?action=commentPost&id=<?= $datas['book']['id'];?>" method="POST">
        <label for="title">Titre de votre commentaire</label>
        <input type="text" maxlength="40" name="title">
        <label for="content">Votre commentaire</label>
        <textarea name="content"></textarea>
        <button type="submit" class="btn btn-main center">Publier</button>
    </form>
    <?php }else{ ?>
        <p class="text-center">Vous devez être connecté.e pour poster un commentaire</p>
    <?php } ;?>
</section>


 <!-- Div for error management -->
 <?php if(isset($datas['feedback'])) {;?>
        <div id="feedback" class="center <?= $datas['feedback']['code'] ?>"><p><i class="fa-solid fa-circle-<?= $datas['feedback']['code']  == "error" ? "xmark" : "check"; ?>"></i> <?= $datas['feedback']['message'] ?></p></div>
<?php }; ?>

<!-- All comments about this book -->
<section id="all-comments" class="container">
    <h2 class="text-center">Toutes vos réactions</h2>
    <?php if(empty($datas['comments'])){?>
        <p class="text-center">Soyez le premier à commenter cet article !</p>
    <?php };?>
    <?php foreach ($datas['comments'] as $data){?>
        <article id="comment<?= $data['id']; ?>" class="flex-md">
            <div class="user-info">
                <p><img <?php 
                if(isset($data['userPicture'])){?>
                    src="./App/Public/Users/images/<?= $data['userPicture'];?>"
                    alt="Avatar de <?= $data['userPseudo'];?>"
                <?php }elseif(isset($data['adminPicture'])){?>
                    src="./App/Public/Admin/images/<?= $data['adminPicture'];?>"
                    alt="Avatar de <?= $data['adminPseudo'];?>"
                <?php } ?> 
                ></p>
                <p class="<?php if(isset($data['adminPseudo'])){ echo "admin-comment ";}?>bold pseudo"><?= $data['userPseudo']; echo $data['adminPseudo'];?></p>
                <p class="date">Publié le <?= $data['created_at']; ?></p>
            </div>
            <div class="comment">
                <h3 class="<?php if(isset($data['adminPseudo'])){ echo "admin-comment ";}?>title bold"><?= $data['commentTitle']; ?></h3>
                <p class="content"><?= $data['commentContent']; ?></p>
            </div>
        </article>
    <?php }; ?>
</section>

<?php include ('layouts/footer.php')?>