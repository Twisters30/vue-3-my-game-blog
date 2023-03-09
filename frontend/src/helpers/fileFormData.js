export const fileFormData = (data) => {
  const bodyFormData = new FormData();
  for (const [key, value] of Object.entries(data)) {
    bodyFormData.append(key, value);
  }

  return bodyFormData;
};
