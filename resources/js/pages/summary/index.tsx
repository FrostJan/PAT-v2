import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import { Bar, BarChart, CartesianGrid, Cell, Legend, Pie, PieChart, ResponsiveContainer, Tooltip, XAxis, YAxis } from 'recharts';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Calendar', href: '/dashboard' },
    { title: 'Summary Statistics', href: '/summary' },
];

interface Props {
    year: number;
    month: number | null;
    approvedVsDeclined: { approved: number; declined: number; pending: number };
    perDepartment: { department: string; total: number }[];
    monthly: { month: number; total: number }[];
}

const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

export default function SummaryIndex({ year, month, approvedVsDeclined, perDepartment, monthly }: Props) {
    const [selectedYear, setYear] = useState<string>(String(year));
    const [selectedMonth, setMonth] = useState<string>(month ? String(month) : '');

    const reload = (y: string, m: string) => {
        router.get('/summary', { year: y || undefined, month: m || undefined }, { preserveState: true, preserveScroll: true });
    };

    const pieData = [
        { name: 'Approved', value: approvedVsDeclined.approved, fill: '#16a34a' },
        { name: 'Declined', value: approvedVsDeclined.declined, fill: '#dc2626' },
        { name: 'Pending', value: approvedVsDeclined.pending, fill: '#eab308' },
    ];

    const monthlyChart = MONTHS.map((label, i) => {
        const row = monthly.find((r) => r.month === i + 1);
        return { label, total: row?.total ?? 0 };
    });

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Summary" />
            <div className="flex h-full flex-1 flex-col gap-4 p-4">
                <div className="flex flex-wrap items-center gap-4">
                    <h1 className="text-2xl font-bold tracking-tight">Summary statistics</h1>
                    <div className="ml-auto flex items-center gap-2">
                        <Select
                            value={selectedYear}
                            onValueChange={(v) => {
                                setYear(v);
                                reload(v, selectedMonth);
                            }}
                        >
                            <SelectTrigger className="w-28">
                                <SelectValue />
                            </SelectTrigger>
                            <SelectContent>
                                {yearRange().map((y) => (
                                    <SelectItem key={y} value={String(y)}>
                                        {y}
                                    </SelectItem>
                                ))}
                            </SelectContent>
                        </Select>
                        <Select
                            value={selectedMonth}
                            onValueChange={(v) => {
                                setMonth(v);
                                reload(selectedYear, v);
                            }}
                        >
                            <SelectTrigger className="w-32">
                                <SelectValue placeholder="All months" />
                            </SelectTrigger>
                            <SelectContent>
                                {MONTHS.map((m, i) => (
                                    <SelectItem key={i} value={String(i + 1)}>
                                        {m}
                                    </SelectItem>
                                ))}
                            </SelectContent>
                        </Select>
                    </div>
                </div>

                <div className="grid gap-4 lg:grid-cols-2">
                    <ChartCard title="Approved / Declined / Pending">
                        <ResponsiveContainer width="100%" height={280}>
                            <PieChart>
                                <Pie data={pieData} dataKey="value" nameKey="name" outerRadius={100} label>
                                    {pieData.map((d) => (
                                        <Cell key={d.name} fill={d.fill} />
                                    ))}
                                </Pie>
                                <Tooltip />
                                <Legend />
                            </PieChart>
                        </ResponsiveContainer>
                    </ChartCard>

                    <ChartCard title="Monthly events">
                        <ResponsiveContainer width="100%" height={280}>
                            <BarChart data={monthlyChart}>
                                <CartesianGrid strokeDasharray="3 3" />
                                <XAxis dataKey="label" />
                                <YAxis allowDecimals={false} />
                                <Tooltip />
                                <Bar dataKey="total" fill="#3b82f6" />
                            </BarChart>
                        </ResponsiveContainer>
                    </ChartCard>

                    <ChartCard title="Requests by department" className="lg:col-span-2">
                        <ResponsiveContainer width="100%" height={320}>
                            <BarChart data={perDepartment} layout="vertical" margin={{ left: 100 }}>
                                <CartesianGrid strokeDasharray="3 3" />
                                <XAxis type="number" allowDecimals={false} />
                                <YAxis type="category" dataKey="department" width={280} />
                                <Tooltip />
                                <Bar dataKey="total" fill="#22c55e" />
                            </BarChart>
                        </ResponsiveContainer>
                    </ChartCard>
                </div>
            </div>
        </AppLayout>
    );
}

function ChartCard({
    title,
    className,
    children,
}: {
    title: string;
    className?: string;
    children: React.ReactNode;
}) {
    return (
        <div className={`rounded-xl border bg-background p-4 ${className ?? ''}`}>
            <h2 className="mb-3 text-lg font-semibold">{title}</h2>
            {children}
        </div>
    );
}

function yearRange(): number[] {
    const now = new Date().getFullYear();
    return Array.from({ length: 10 }, (_, i) => now - i);
}
