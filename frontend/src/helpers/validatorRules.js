import { object, string } from "yup";

export const schemaLogin = object({
  email: string().required("не заполненно").email("Email не валиден"),
  password: string()
    .required("Пароль не заполнен")
    .min(6, `Пароль должен быть минимум ${6} символов`),
});
