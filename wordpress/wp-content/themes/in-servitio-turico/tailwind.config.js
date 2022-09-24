module.exports = {
  content: require("fast-glob").sync(["./**/*.php", "*.php"]),
  safelist: ["bg-accent-10"],
  theme: {
    extend: {
      colors: {
        accent: {
          DEFAULT: "var(--accent)",
          10: "var(--accent-10)",
          20: "var(--accent-20)",
          30: "var(--accent-30)",
          40: "var(--accent-40)",
          50: "var(--accent-50)",
          60: "var(--accent-60)",
          70: "var(--accent-70)",
          80: "var(--accent-80)",
          90: "var(--accent-90)",
          110: "var(--accent-110)",
          120: "var(--accent-120)",
        },
        current: "currentColor",
        white: "#ffffff",
      },
    },
  },
  plugins: [],
};
