module.exports = {
    darkMode: 'class',
    purge: {
        content: [
            './resources/**/*.blade.php',
            './resources/**/*.js',
            './resources/**/*.vue',
            "./node_modules/flowbite/**/*.js"
        ]
    },
    theme: {},
    variants: {},
    plugins: [
        require('flowbite/plugin')
    ]
}
