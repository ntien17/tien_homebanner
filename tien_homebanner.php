<?php
/**
 * Plugin Name: Tiên Homepage Banner
 * Description: Hiển thị một popup quảng cáo/thông báo khi người dùng truy cập trang chủ.
 * Version: 1.0
 * Author: Phúc Tiên
 */

// Ngăn chặn truy cập trực tiếp vào file
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Hàm chèn mã HTML, CSS và JS vào phần footer của trang
function tien_display_homepage_banner() {
    
    // Chỉ hiển thị banner nếu đang ở trang chủ (Front page)
    if ( ! is_front_page() ) {
        return;
    }
    ?>

    <style>
    #tien-banner-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(10, 10, 20, 0.85);
        backdrop-filter: blur(6px); /* làm mờ nền phía sau */
        z-index: 99999;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 1;
        transition: opacity 0.4s ease;
    }

    #tien-banner-content {
        position: relative;
        background: linear-gradient(135deg, #141e30, #243b55);
        color: #fff;
        padding: 35px 30px;
        border-radius: 18px;
        text-align: center;
        max-width: 520px;
        width: 90%;
        box-shadow: 
            0 0 20px rgba(255, 215, 0, 0.3),
            0 0 40px rgba(255, 100, 100, 0.2),
            0 10px 40px rgba(0,0,0,0.8);
        animation: popup-appear 0.5s ease;
        border: 1px solid rgba(255,255,255,0.1);
    }

    /* Hiệu ứng xuất hiện */
    @keyframes popup-appear {
        from {
            transform: scale(0.7);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Nút đóng */
    .tien-banner-close {
        position: absolute;
        top: 12px;
        right: 15px;
        font-size: 26px;
        font-weight: bold;
        color: #aaa;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .tien-banner-close:hover {
        color: #ff4d4d;
        transform: rotate(90deg) scale(1.2);
    }

    /* Nút CTA */
    .tien-banner-btn {
        display: inline-block;
        margin-top: 25px;
        padding: 12px 28px;
        background: linear-gradient(45deg, #ff416c, #ff4b2b);
        color: #fff;
        text-decoration: none;
        border-radius: 30px;
        font-weight: bold;
        letter-spacing: 1px;
        box-shadow: 0 0 15px rgba(255,75,75,0.6);
        transition: all 0.3s ease;
    }

    .tien-banner-btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 0 25px rgba(255,75,75,1);
    }

    /* Glow tiêu đề */
    .glow-text {
        color: #ffd166;
        text-shadow: 
            0 0 5px #ffd166,
            0 0 10px #ffd166,
            0 0 20px #ff9f1c,
            0 0 30px #ff6b6b;
        animation: glowPulse 1.5s infinite alternate;
    }

    @keyframes glowPulse {
        from {
            text-shadow: 
                0 0 5px #ffd166,
                0 0 10px #ffd166;
        }
        to {
            text-shadow: 
                0 0 15px #fff,
                0 0 25px #ff6b6b,
                0 0 35px #ff0000;
        }
    }
    </style>

    <div id="tien-banner-overlay">
  <div id="tien-banner-content">
    <span class="tien-banner-close" id="tien-close-btn">&times;</span>
    <h2 style="color:#ffd166; font-size:28px;">✨ KÉO RANK LIÊN QUÂN CAO THỦ ✨</h2>

    <p style="font-size:16px; line-height:1.6;">
    🚀 Leo rank <strong>siêu tốc – an toàn tuyệt đối</strong><br>
    🔒 Bảo mật 100% – Không lo khóa acc<br>
    🎯 Cam kết lên <strong>Thách Đấu</strong> đúng hẹn<br>
    💎 Hỗ trợ 24/7 – Giá cực kỳ hợp lý
    </p>

    <p style="margin-top:10px; font-style:italic; color:#f1faee;">
    👉 Đừng để đồng đội “gánh”, hãy để <strong>Tiến gánh bạn!</strong>
    </p>

    <a href="https://zalo.me/0359198005" class="tien-banner-btn">
    ⚡ Liên hệ ngay – Nhận ưu đãi hôm nay!
    </a>
  </div>
</div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var overlay = document.getElementById("tien-banner-overlay");
            var closeBtn = document.getElementById("tien-close-btn");

            // Xử lý khi bấm nút X
            closeBtn.addEventListener("click", function() {
                overlay.style.opacity = "0";
                setTimeout(function() {
                    overlay.style.display = "none";
                }, 300); // Đợi 0.3s cho hiệu ứng fade out
            });

            // Xử lý khi bấm ra ngoài khoảng trắng (background mờ)
            overlay.addEventListener("click", function(event) {
                if (event.target === overlay) {
                    overlay.style.opacity = "0";
                    setTimeout(function() {
                        overlay.style.display = "none";
                    }, 300);
                }
            });
        });
    </script>

    <?php
}

// Móc hàm vào hook 'wp_footer' để đảm bảo code chạy sau khi trang đã load xong các thành phần chính
add_action( 'wp_footer', 'tien_display_homepage_banner' );