module.exports = {
    env: {
        browser: true,
        es2021: true,
    },
    extends: [
        'plugin:vue/essential',
        'plugin:vue/recommended',
    ],
    parserOptions: {
        ecmaVersion: 12,
        sourceType: 'module',
    },
    plugins: [
        'vue',
    ],
    rules: {
        'vue/html-indent': ['error', 2],
        'vue/script-indent': ['error', 2],
        'vue/max-attributes-per-line': [0, {
            'singleline': 2,
            'multiline': {
                'max': 1,
                'allowFirstLine': true
            }
        }],
        'semi': [2, 'never'],
        'no-unused-vars': 'error',

        'vue/singleline-html-element-content-newline': 'off',
        'vue/multiline-html-element-content-newline': 'off',
    },
}
