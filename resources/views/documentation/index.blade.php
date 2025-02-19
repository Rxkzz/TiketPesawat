<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi TiketPesawat</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: #f0f2f5;
        }

        .book-container {
            display: flex;
            min-height: 100vh;
            background: #fff;
            max-width: 1400px;
            margin: 0 auto;
            box-shadow: 0 0 50px rgba(0,0,0,0.1);
        }

        .sidebar {
            width: 300px;
            background: #1a1a1a;
            color: #fff;
            padding: 2rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .content {
            flex: 1;
            margin-left: 300px;
            padding: 2rem 4rem;
            max-width: 1100px;
            line-height: 1.8;
        }

        .toc-item {
            padding: 0.5rem 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toc-item:hover {
            color: #60a5fa;
        }

        .markdown-body {
            font-size: 1.1rem;
            color: #333;
        }

        .markdown-body h1 { 
            @apply text-4xl font-bold mb-8 pb-4 border-b-2 border-gray-200;
            color: #1a1a1a;
        }

        .markdown-body h2 { 
            @apply text-3xl font-bold mb-6 mt-12;
            color: #2d3748;
        }

        .markdown-body h3 { 
            @apply text-2xl font-semibold mb-4 mt-8;
            color: #4a5568;
        }

        .markdown-body p { 
            @apply mb-6 leading-relaxed;
        }

        .markdown-body ul { 
            @apply list-disc pl-6 mb-6 space-y-2;
        }

        .markdown-body ol { 
            @apply list-decimal pl-6 mb-6 space-y-2;
        }

        .markdown-body li { 
            @apply mb-2 leading-relaxed;
        }

        .markdown-body code { 
            @apply bg-gray-100 px-2 py-1 rounded text-sm font-mono;
        }

        .markdown-body pre { 
            @apply bg-gray-900 text-white p-4 rounded-lg mb-6 overflow-x-auto;
            font-family: 'Fira Code', monospace;
        }

        .markdown-body a { 
            @apply text-blue-600 hover:underline font-medium;
        }

        .page-controls {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            display: flex;
            gap: 1rem;
        }

        .control-button {
            @apply bg-gray-800 text-white px-4 py-2 rounded-full hover:bg-gray-700 transition-all;
        }

        /* Dark mode toggle */
        .dark-mode-toggle {
            position: fixed;
            top: 2rem;
            right: 2rem;
            cursor: pointer;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .content {
                margin-left: 0;
                padding: 1rem;
            }
        }

        /* Print styles */
        @media print {
            .sidebar, .page-controls, .dark-mode-toggle {
                display: none;
            }
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="book-container">
        <!-- Sidebar with Table of Contents -->
        <div class="sidebar">
            <h2 class="text-xl font-bold mb-6">Daftar Isi</h2>
            <div class="toc">
                <!-- Generated dynamically via JavaScript -->
            </div>
        </div>

        <!-- Main Content -->
        <div class="content">
            <div class="markdown-body">
                {!! $html !!}
            </div>
        </div>

        <!-- Page Controls -->
        <div class="page-controls">
            <button class="control-button" onclick="window.print()">
                <i class="fas fa-print mr-2"></i> Cetak
            </button>
            <button class="control-button" id="zoom-in">
                <i class="fas fa-search-plus"></i>
            </button>
            <button class="control-button" id="zoom-out">
                <i class="fas fa-search-minus"></i>
            </button>
        </div>

        <!-- Dark Mode Toggle -->
        <div class="dark-mode-toggle">
            <button class="control-button" id="dark-mode-toggle">
                <i class="fas fa-moon"></i>
            </button>
        </div>
    </div>

    <script>
        // Generate Table of Contents
        document.addEventListener('DOMContentLoaded', function() {
            const content = document.querySelector('.markdown-body');
            const toc = document.querySelector('.toc');
            const headings = content.querySelectorAll('h1, h2, h3');
            
            headings.forEach((heading, index) => {
                const link = document.createElement('div');
                link.className = 'toc-item';
                link.style.paddingLeft = `${(heading.tagName[1] - 1) * 1}rem`;
                link.textContent = heading.textContent;
                
                // Add click event to scroll to section
                link.addEventListener('click', () => {
                    heading.scrollIntoView({ behavior: 'smooth' });
                });
                
                toc.appendChild(link);
            });
        });

        // Zoom Controls
        let currentZoom = 100;
        document.getElementById('zoom-in').addEventListener('click', () => {
            currentZoom += 10;
            document.querySelector('.markdown-body').style.fontSize = `${currentZoom}%`;
        });

        document.getElementById('zoom-out').addEventListener('click', () => {
            currentZoom -= 10;
            document.querySelector('.markdown-body').style.fontSize = `${currentZoom}%`;
        });

        // Dark Mode Toggle
        let isDarkMode = false;
        document.getElementById('dark-mode-toggle').addEventListener('click', () => {
            isDarkMode = !isDarkMode;
            const content = document.querySelector('.markdown-body');
            if (isDarkMode) {
                content.style.background = '#1a1a1a';
                content.style.color = '#fff';
                document.querySelector('.book-container').style.background = '#1a1a1a';
            } else {
                content.style.background = '#fff';
                content.style.color = '#333';
                document.querySelector('.book-container').style.background = '#fff';
            }
        });
    </script>
</body>
</html> 