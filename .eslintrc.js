module.exports = {
    env: {
        node: true,
        browser: true,
        es2021: true,
    },
    extends: [
        "eslint:recommended",
        "plugin:vue/vue3-recommended",
    ],
    parser: "vue-eslint-parser",
    parserOptions: {
        ecmaVersion: 12,
        sourceType: "module",
    },
    plugins: ["vue"],
    rules: {
        "vue/html-indent": ["error", 4, {
            attribute: 1,
            baseIndent: 1,
            closeBracket: 0,
            alignAttributesVertically: true,
        }],
        "vue/script-indent": ["error", 4, {baseIndent: 1, switchCase: 1}],
        "vue/require-prop-types": 0,
        "semi": "error",
        "comma-dangle": ["error", "always-multiline"],
    },
    overrides: [
        {
            files: ["*.vue"],
            rules: {
                indent: "off",
            },
        },
    ],
    globals: {
        "axios": true,
    },
};
