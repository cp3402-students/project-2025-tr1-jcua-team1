module.exports = {
  extends: ['stylelint-config-standard', 'stylelint-config-wordpress'],
  rules: {
    'indentation': 2,
    'no-descending-specificity': null,
    'no-duplicate-selectors': true,
    'color-named': 'never',
    'color-hex-case': 'lower',
  },
  ignoreFiles: ['dist/**', 'build/**', 'vendor/**', 'node_modules/**'],
};
