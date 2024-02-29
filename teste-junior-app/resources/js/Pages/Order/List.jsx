import React, { useState, useEffect } from "react";
import axios from "axios";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { Table } from "rsuite";
import "rsuite/Table/styles/index.css";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faEdit, faTrash } from "@fortawesome/free-solid-svg-icons";

const { Column, HeaderCell, Cell } = Table;

export default function List({ auth }) {
    const [orders, setOrders] = useState([]);

    const IconButton = ({ icon, onClick }) => {
        return (
            <button className="icon-button" onClick={onClick}>
                <FontAwesomeIcon icon={icon} />
            </button>
        );
    };

    const handleDelete = async (orderId) => {
        try {
            const response = await axios.delete(`/api/delete/orders/${orderId}`, {
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            if (response.status === 200) {
                console.log('Order deleted successfully');
                window.location.reload();
            } else {
                console.error('Failed to delete order');
            }
        } catch (error) {
            console.error('Error deleting order:', error);
        }
    };

    useEffect(() => {
        axios
            .get("/api/orders")
            .then((response) => {
                setOrders(response.data);
            })
            .catch((error) => {
                console.error("Error fetching orders:", error);
                setError(error);
            });
    }, []);


    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Pedidos
                </h2>
            }
        >
            <Head title="Pedidos" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <Table
                        height={600}
                        data={Object.values(orders)}
                        onRowClick={(rowData) => {
                            console.log(rowData);
                        }}
                    >

                        <Column width={150} fixed>
                            <HeaderCell>ID</HeaderCell>
                            <Cell dataKey="uuid" />
                        </Column>
                        <Column width={150} fixed>
                            <HeaderCell>Status</HeaderCell>
                            <Cell dataKey="status" />
                        </Column>
                        <Column width={150}>
                            <HeaderCell>Cliente</HeaderCell>
                            <Cell dataKey="client" />
                        </Column>
                        <Column width={40} fixed="right">
                            <HeaderCell></HeaderCell>
                            <Cell style={{ padding: "6px" }}>
                                {(rowData) => (
                                    <IconButton
                                        icon={faEdit}
                                        onClick={() => handleEdit(rowData.uuid)}
                                    />
                                )}
                            </Cell>
                        </Column>

                        <Column width={40} fixed="right">
                            <HeaderCell></HeaderCell>
                            <Cell style={{ padding: "6px" }}>
                                {(rowData) => (
                                    <IconButton
                                        icon={faTrash}
                                        onClick={() => handleDelete(rowData.uuid)}
                                    />
                                )}
                            </Cell>
                        </Column>
                    </Table>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
