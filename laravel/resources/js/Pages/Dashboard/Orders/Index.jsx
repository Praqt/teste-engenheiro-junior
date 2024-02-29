import FiltersHeader from "@/Components/FiltersHeader";
import NavLink from "@/Components/NavLink";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { fields } from "@/lib/enums/OrdersFields";
import { normalizeStatus } from "@/lib/enums/StatusEnum";
import { makeQueryString } from "@/lib/makeQueryString";
import { Head, router } from "@inertiajs/react";

export default function Orders({ auth, orders }) {
    function handleFilterSubmit(e) {
        e.preventDefault();

        const query = makeQueryString(e);

        router.visit(window.location.pathname + query, {
            replace: false,
            preserveState: true,
        });
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <div className="flex flex-col gap-y-4">
                    <div className="flex justify-between">
                        <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            Listagem de Pedidos
                        </h2>
                        <NavLink href={route("dashboard.orders.create")}>
                            Novo Pedido
                        </NavLink>
                    </div>
                    <FiltersHeader
                        fields={fields}
                        handleFilterSubmit={handleFilterSubmit}
                    />
                </div>
            }
        >
            <Head title="Orders" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <table className="w-full table-auto text-gray-900 dark:text-gray-200">
                            <thead>
                                <tr>
                                    <th className="text-start py-4 px-10 border-b border-slate-600 bg-red-900">
                                        ID
                                    </th>
                                    <th className="text-start border-b border-slate-600 bg-red-900">
                                        Status
                                    </th>
                                    <th className="text-start border-b border-slate-600 bg-red-900">
                                        Preço Total
                                    </th>
                                    <th className="text-start border-b border-slate-600 bg-red-900">
                                        Opções
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {orders.length > 0 ? (
                                    orders.map((order, i) => (
                                        <tr key={i}>
                                            <td className="py-4 px-10">
                                                {order.id}
                                            </td>
                                            <td>
                                                {normalizeStatus(order.status)}
                                            </td>
                                            <td>
                                                {(
                                                    order.total_price / 100
                                                ).toFixed(2)}
                                            </td>
                                            <td>
                                                <NavLink
                                                    href={route(
                                                        "dashboard.orders.show",
                                                        order.id,
                                                    )}
                                                >
                                                    Visualizar
                                                </NavLink>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td className="py-4 px-10">
                                            Nenhum item registrado!
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
