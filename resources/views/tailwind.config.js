/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            // ===== Warna & token sinkron dengan index.html (dashboard mahasiswa & panitia) =====
            colors: {
                navy: {
                    900: '#152159',
                    700: '#1e3a8f',
                    600: '#2a4bb0',
                    tint: '#e6e9f6',
                },
                teal: {
                    600: '#0f8a8c',
                    500: '#16a0a1',
                    tint: '#e2f3f2',
                },
                lime: {
                    500: '#a9c73b',
                    tint: '#f2f6e0',
                },
                coral: {
                    500: '#e0665a',
                    tint: '#fbeae8',
                },
                bg: '#f2f4fa',
                surface: '#ffffff',
                'surface-muted': '#e8ebf6',
                border: '#e1e5f1',
                ink: {
                    900: '#1b2238',
                    600: '#5b6175',
                    400: '#8d92a6',
                },
            },
            fontFamily: {
                display: ['Lora', 'serif'],
                sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            },
            borderRadius: {
                lg: '28px',
                md: '18px',
                sm: '13px',
            },
            boxShadow: {
                card: '0 2px 14px rgba(21, 33, 89, 0.07), 0 1px 2px rgba(21, 33, 89, 0.05)',
                pop: '0 10px 24px rgba(21, 33, 89, 0.16)',
            },
            width: {
                'sidebar-tablet': '84px',
                'sidebar-desktop': '264px',
            },
            keyframes: {
                pulse-dot: {
                    '0%, 100%': { opacity: 1 },
                    '50%': { opacity: 0.35 },
                },
            },
            animation: {
                'pulse-dot': 'pulse-dot 1.6s infinite ease-in-out',
            },
        },
    },
    plugins: [],
};
