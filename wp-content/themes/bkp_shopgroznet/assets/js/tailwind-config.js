tailwind.config = {
    theme: {
        container: {
            center: true,
            padding: '16px',
            screens: {
                sm: '640px',
                md: '768px',
                lg: '1024px',
                xl: '1280px',
                '2xl': '1280px'
            }
        },
        extend: {
            fontFamily: {
                serif: ['serif'],
                sans: ['Arial', 'Helvetica', 'sans-serif']
            }
        }
    },
    corePlugins: {
        preflight: true
    }
}