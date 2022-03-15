import { shallowMount, mount } from "@vue/test-utils";
import Login from "../../pages/auth/login";

test("sets the value", async () => {
  const wrapper = mount(Login);
  const input = wrapper.find("input");

  await input.setValue("my@mail.com");

  expect(input.element.value).toBe("my@mail.com");
});
