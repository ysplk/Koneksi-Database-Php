<?php
// memuai sesi
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Logic sortir dosen
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'dosen') {
?>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>403 FORBIDDEN - AKSES DITOLAK</title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=IBM+Plex+Mono|Sedgwick+Ave+Display');

            :root {
                --font-display: 'Sedgwick Ave Display', cursive;
                --font-sans-serif: 'IBM Plex Mono', monospace;
                --box-shadow: 0px 21px 34px 0px rgba(0, 0, 0, 0.89);
                --color-bg: linear-gradient(to bottom, rgba(35, 37, 38, 1) 0%, rgba(32, 38, 40, 1) 100%);
                --scene-width: 400px;
                --scene-height: 400px;
                --delay-base: 500ms;
                --delay-added: 100ms;
                /* acc-back cubic-bezier */
                --acc-back: cubic-bezier(0.390, 0.575, 0.565, 1.000);
            }

            *,
            *:before,
            *:after {
                box-sizing: border-box;
                -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
            }

            body {
                width: 100vw;
                height: 100vh;
                margin: 0;
                padding: 0;
                background: var(--color-bg);
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                overflow: hidden;
                font-family: var(--font-sans-serif);
            }

            .scene {
                position: relative;
                width: var(--scene-width);
                height: var(--scene-height);
                transition: transform 600ms var(--acc-back);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .scene:hover {
                transform: scale(.98) skewY(-1deg);
            }

            .scene>* {
                transition: transform 600ms var(--acc-back);
            }

            .text {
                transition: transform 600ms var(--acc-back), opacity 100ms ease-in;
                height: inherit;
                width: 100%;
                height: 100%;
                z-index: 7;
                position: relative;
                pointer-events: none;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .scene:hover .text {
                opacity: 1;
                transform: scale(.91);
            }

            @keyframes popInImg {
                0% {
                    transform: skewY(5deg) scaleX(.89) scaleY(.89);
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }
            }

            .text span {
                display: block;
                font-family: var(--font-sans-serif);
                text-align: center;
                text-shadow: var(--box-shadow);
                animation: popIn 600ms var(--acc-back) 1 forwards;
                opacity: 0;
            }

            @keyframes popIn {

                0%,
                13% {
                    transform: scaleX(.89) scaleY(.75);
                    opacity: 0;
                }

                100% {
                    opacity: 1;
                }
            }

            .bg-403 {
                font-size: 250px;
                font-family: var(--font-display);
                animation-delay: calc(var(--delay-base) + 2 * var(--delay-added));
                z-index: 0;
                background: linear-gradient(to top, rgba(32, 38, 40, 0) 25%, rgba(49, 57, 61, 1) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                transform: translateX(-10%) translateZ(-100px) skewY(-3deg);
                position: absolute;
                pointer-events: none;
                transition: transform 1200ms var(--acc-back);
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) skewY(-3deg);
                width: 100%;
                text-align: center;
                line-height: 1;
            }

            .msg {
                font-size: 28px;
                animation-delay: calc(var(--delay-base) + 3 * var(--delay-added));
                color: #8b8b8b;
                margin-top: 20px;
                letter-spacing: 2px;
            }

            .msg span {
                transform: skewX(-13deg);
                display: inline-block;
                color: #fff;
                letter-spacing: -1px;
            }

            .support {
                font-size: 18px;
                animation-delay: calc(var(--delay-base) + 4 * var(--delay-added));
                display: block;
                margin-top: 30px;
                color: #686a6b;
            }

            .support span {
                margin-bottom: 5px;
            }

            .support a {
                display: inline-block;
                color: #b2b3b4;
                text-decoration: none;
                pointer-events: initial;
                border-bottom: 1px dashed #b2b3b4;
                padding-bottom: 2px;
                transition: color 0.3s;
                cursor: pointer;
            }

            .support a:hover {
                color: #fff;
                border-bottom: 1px solid #fff;
            }

            .overlay {
                display: block;
                position: absolute;
                cursor: pointer;
                width: 50%;
                height: 50%;
                z-index: 1;
                transform: translateZ(34px);
            }

            .overlay:nth-of-type(1) {
                left: 0;
                top: 0;
            }

            .overlay:nth-of-type(2) {
                right: 0;
                top: 0;
            }

            .overlay:nth-of-type(3) {
                bottom: 0;
                right: 0;
            }

            .overlay:nth-of-type(4) {
                bottom: 0;
                left: 0;
            }

            .lock {
                /* Lock Pixel Art */
                box-shadow:
                    32px 8px 0 0 #e4e4e4, 40px 8px 0 0 #e4e4e4, 48px 8px 0 0 #e4e4e4, 56px 8px 0 0 #e4e4e4,
                    24px 16px 0 0 #cbcbcb, 32px 16px 0 0 #cbcbcb, 40px 16px 0 0 #909090, 48px 16px 0 0 #909090, 56px 16px 0 0 #cbcbcb, 64px 16px 0 0 #e4e4e4,
                    16px 24px 0 0 #cbcbcb, 24px 24px 0 0 #cbcbcb, 32px 24px 0 0 #909090, 56px 24px 0 0 #909090, 64px 24px 0 0 #cbcbcb, 72px 24px 0 0 #e4e4e4,
                    16px 32px 0 0 #cbcbcb, 24px 32px 0 0 #909090, 64px 32px 0 0 #909090, 72px 32px 0 0 #cbcbcb,
                    16px 40px 0 0 #cbcbcb, 24px 40px 0 0 #909090, 64px 40px 0 0 #909090, 72px 40px 0 0 #cbcbcb,
                    16px 48px 0 0 #909090, 24px 48px 0 0 #909090, 64px 48px 0 0 #909090, 72px 48px 0 0 #909090,
                    8px 56px 0 0 #fbec79, 16px 56px 0 0 #fbec79, 24px 56px 0 0 #fbec79, 32px 56px 0 0 #fbec79, 40px 56px 0 0 #fbec79, 48px 56px 0 0 #fbec79, 56px 56px 0 0 #fbec79, 64px 56px 0 0 #fbec79, 72px 56px 0 0 #fbec79, 80px 56px 0 0 #fbec79,
                    8px 64px 0 0 #ffc107, 16px 64px 0 0 #ffc107, 24px 64px 0 0 #ffc107, 32px 64px 0 0 #ffc107, 40px 64px 0 0 #ffc107, 48px 64px 0 0 #ffc107, 56px 64px 0 0 #ffc107, 64px 64px 0 0 #ffc107, 72px 64px 0 0 #ffc107, 80px 64px 0 0 #ffc107,
                    8px 72px 0 0 #ffc107, 16px 72px 0 0 #ffc107, 24px 72px 0 0 #ffc107, 32px 72px 0 0 #ffc107, 40px 72px 0 0 #ffc107, 48px 72px 0 0 #ffc107, 56px 72px 0 0 #ffc107, 64px 72px 0 0 #ffc107, 72px 72px 0 0 #ffc107, 80px 72px 0 0 #ffc107,
                    8px 80px 0 0 #ff9800, 16px 80px 0 0 #ffc107, 24px 80px 0 0 #ffc107, 32px 80px 0 0 #ffc107, 40px 80px 0 0 #ffc107, 48px 80px 0 0 #ff9800, 56px 80px 0 0 #ff9800, 64px 80px 0 0 #ff9800, 72px 80px 0 0 #ff9800,
                    16px 88px 0 0 #ff9800, 24px 88px 0 0 #ff9800, 32px 88px 0 0 #ff9800, 40px 88px 0 0 #ff9800, 48px 88px 0 0 #ff9800, 56px 88px 0 0 #ff9800, 64px 88px 0 0 #ff9800, 72px 88px 0 0 #ff9800,
                    24px 96px 0 0 #ff9800, 32px 96px 0 0 #ff9800, 40px 96px 0 0 #ff9800, 48px 96px 0 0 #ff9800, 56px 96px 0 0 #ff9800, 64px 96px 0 0 #ff9800;
                height: 8px;
                width: 8px;
                position: absolute;
                left: calc(50% - 48px);
                top: 0;
                transform-style: preserve-3d;
                backface-visibility: hidden;
                pointer-events: none;
                outline: 1px solid transparent;
            }
        </style>
    </head>

    <body>

        <div class="scene">
            <div class="overlay"></div>
            <div class="overlay"></div>
            <div class="overlay"></div>
            <div class="overlay"></div>
            <span class="bg-403">403</span>
            <div class="text">
                <span class="hero-text">FORBIDDEN</span>
                <span class="msg">can't let <span>you</span> in.</span>
                <span class="support">
                    <span>
                        access denied</span>
                    <a href="javascript:history.back()">return to the dashboard</a>
                </span>
            </div>
            <div class="lock"></div>
        </div>

    </body>

    </html>
<?php
    exit();
}
?>