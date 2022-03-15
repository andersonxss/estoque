import pedidos from "@/pages/pedidos/index";

import pedidosSolicitar from "@/pages/pedidos/pedidos_solicitar";
import produtos from "@/pages/produtos/index";
import produtocadastro from "@/pages/produtos/produtos_cadastro";
import produtoeditar from "@/pages/produtos/produtos_editar";

import usuarios from "@/pages/usuarios/index";
import usuarioscadastro from "@/pages/usuarios/usuarios_cadastro";
import usuarioseditar from "@/pages/usuarios/usuarios_editar";

import login from "@/pages/auth/login";
import register from "@/pages/auth/register";
import NotFound from "@/pages/notFound";

const routes = [
  {
    path: "/",
    component: () => import("@/Home"),
    children: [
      {
        path: "/",
        name: "pedidos",
        component: pedidos,
      },
      {
        path: "/pedidos",
        name: "pedidos",
        component: pedidos,
      },
      {
        path: "/pedidos/action/:id",
        name: "pedidosSolicitar",
        component: pedidosSolicitar,
      },
      {
        path: "/produtos",
        name: "produtos",
        component: produtos,
      },
      {
        path: "/produtos/cadastro",
        name: "produtosCadastro",
        component: produtocadastro,
      },
      {
        path: "/produtos/editar/:id",
        name: "produtoseditar",
        component: produtoeditar,
      },
      {
        path: "/usuarios",
        name: "usuarios",
        component: usuarios,
      },
      {
        path: "/usuarios/cadastro",
        name: "usuarioscadastro",
        component: usuarioscadastro,
      },
      {
        path: "/usuarios/editar/:id",
        name: "usuarioseditar",
        component: usuarioseditar,
      },
    ],
  },

  {
    path: "/",
    component: () => import("@/Login"),
    children: [
      {
        path: "/login",
        name: "login",
        component: login,
      },
      {
        path: "/registrar",
        name: "register",
        component: register,
      },
    ],
  },
  {
    path: "*",
    component: NotFound,
    meta: {
      title: "Página não encontrada",
    },
  },
];

export default routes;
