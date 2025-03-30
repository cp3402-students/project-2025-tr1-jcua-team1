module.exports = {
  env: {
    browser: true,
    es2021: true,
    jquery: true,
    node: true,
  },
  extends: [
    'eslint:recommended',
  ],
  parserOptions: {
    ecmaVersion: 'latest',
    sourceType: 'module',
  },
  rules: {
    'no-console': 'warn',
    'no-unused-vars': 'warn',
    'quotes': ['error', 'single'],
    'semi': ['error', 'always'],
  },
  // Ignore build files and vendor directories
  ignorePatterns: ['dist/**', 'build/**', 'vendor/**', 'node_modules/**'],
};
