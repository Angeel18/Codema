<?php
session_start();
if (isset($_SESSION['is_superuser'])) {
session_destroy();
header("location:/");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Codema – Learn to code daily with interactive challenges, gamified streaks and a supportive community.">
    <title>Codema – Learn to Code Daily</title>
  <link rel="icon" type="image/png" href="media/favicon.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="styles/homeStyles.css">
    <link rel="stylesheet" href="styles/ranking.css">

</head>

<body>

    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php"); ?>

    <main>
        <section class="ranking-section reveal">
            <div class="container">
                <h2 class="section-title">Monthly Ranking</h2>

                <div class="ranking-layout">
                    <!-- Podio Top 3 -->
                    <div class="ranking-podium">
                        <div class="podium podium-2">
                            <span class="position" style="background-color: silver;">2</span>
                            <div class="avatar">
                                  <svg viewBox="0 0 64 64" fill="currentColor" width="20" height="20">
                                    <circle cx="32" cy="20" r="12" />
                                    <path d="M10,60 C10,40 54,40 54,60 Z" />
                                </svg>
                            </div>
                            <p id="top2Name"></p>
                            <small id="top2Score"></small>
                        </div>
                        <div class="podium podium-1">
                            <span class="position" style="background-color: gold;">1</span>
                            <div class="avatar">👑</div>
                            <p id="top1Name"></p>
                            <small id="top1Score"></small>
                        </div>
                        <div class="podium podium-3">
                            <span class="position" style="background-color:#cd7f32 ;">3</span>
                            <div class="avatar">
                                <svg viewBox="0 0 64 64" fill="currentColor" width="20" height="20">
                                    <circle cx="32" cy="20" r="12" />
                                    <path d="M10,60 C10,40 54,40 54,60 Z" />
                                </svg>
                            </div>
                            <p id="top3Name"></p>
                            <small id="top3Score"></small>
                        </div>
                    </div>

                    <!-- Tabla restante -->
                    <div class="ranking-table-wrapper">
                        <table class="ranking-table">
                            <thead id="tableHeads">
                                <tr>
                                    <th>Pos</th>
                                    <th>User</th>
                                    <th>Points</th>
                                    <th>Level</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html"); ?>

    <!-- Scroll to top -->
    <!-- <button class="scroll-top" aria-label="scroll back to top">▲</button> -->
    <script src="scripts/monthlyRanking.js"></script>

</body>

</html>