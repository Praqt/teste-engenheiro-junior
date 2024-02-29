import NavLink from "@/Components/NavLink";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { normalizeStatus } from "@/lib/enums/StatusEnum";
import { Head, router } from "@inertiajs/react";
import axios from "axios";
import { useEffect, useState } from "react";

export default function Show({ auth, order }) {
    const [client, setClient] = useState(null);
    
    useEffect(() => {
        if(client === null) {
            axios
                .get(`http://localhost/api/orders/${order.id}/client`, {
                    headers: { Accept: "application/json" }
                })
                .then(res => setClient(res.data))
                .catch(e => console.log(e))
        }
    }, []);

    function handleDelete(e) {
        e.preventDefault();
        router.delete(route("dashboard.orders.destroy", order.id));
    }

    return (
        <AuthenticatedLayout user={auth.user}
            header={
                <div className="flex justify-between">
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Pedido - {order.id}</h2>
                </div>
            }
        >
            <Head title="Orders" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 w-1/2 mx-auto overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="flex justify-between border-b-2 border-slate-950">
                            <h6 className="p-5 text-gray-200">Itens</h6>
                            <div className="flex px-2 gap-x-4">
                                <NavLink href={route("dashboard.orders.edit", order.id)}>Editar</NavLink>
                                <button className="text-red-600 opacity-90 hover:opacity-100 underline-offset-4 underline" onClick={handleDelete}>Deletar</button>
                            </div>
                        </div>
                        <ul className="flex flex-col">
                            <OrderItem label={"Id"} item={order.id} />
                            <OrderItem label={"Cliente"} item={client ? client.data.name : ""} />
                            <OrderItem label={"Status"} item={normalizeStatus(order.status)} />
                            <OrderItem  label={"Preço Total"} item={(order.total_price / 100).toFixed(2)} />
                        </ul>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    )
}

function OrderItem({ label, item }) {
    return (
        <li className="grid grid-cols-3 text-gray-200 border-b border-slate-900">
            <div className="bg-red-900 py-5 px-2 col-span-1 border-r border-slate-900">{label}</div>
            <div className="col-span-2 bg-slate-600 py-5 px-2 text-center">{item}</div>
        </li>
    )
}