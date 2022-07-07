function limitName(name, limit = 1) {
  const formatedName = name.split(" ").filter((_, i) => i < limit).join(" ");
  return formatedName;
}

export {
  limitName,
}