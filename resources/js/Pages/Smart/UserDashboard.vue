<script setup lang="ts">
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { 
  FileText, 
  Plus,
  Clock,
  CheckCircle2,
  Send
} from 'lucide-vue-next';

interface Props {
  user: {
    name: string;
    email: string;
  };
}

const props = defineProps<Props>();

// Sample user requests data
const myRequests = [
  {
    id: 1,
    title: 'Office Supplies Request',
    description: 'Requested 10 reams of paper and printer ink',
    date: '2 days ago',
    status: 'pending',
  },
  {
    id: 2,
    title: 'IT Equipment',
    description: 'New keyboard and mouse replacement',
    date: '1 week ago',
    status: 'approved',
  },
  {
    id: 3,
    title: 'Stationery Items',
    description: 'Pens, markers, and sticky notes',
    date: '2 weeks ago',
    status: 'completed',
  },
];

const getStatusBadge = (status: string) => {
  switch (status) {
    case 'approved':
      return { text: 'Approved', class: 'bg-accent/10 text-accent' };
    case 'pending':
      return { text: 'Pending', class: 'bg-amber-500/10 text-amber-500' };
    case 'completed':
      return { text: 'Completed', class: 'bg-primary/10 text-primary' };
    default:
      return { text: status, class: 'bg-muted text-muted-foreground' };
  }
};

const getStatusIcon = (status: string) => {
  switch (status) {
    case 'approved':
      return CheckCircle2;
    case 'pending':
      return Clock;
    case 'completed':
      return Send;
    default:
      return FileText;
  }
};
</script>

<template>
  <AppLayout title="My Dashboard">
    <template #header>
      <div class="flex flex-col gap-3 sm:gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h1 class="text-lg sm:text-2xl lg:text-3xl font-bold leading-tight">
            Hello, <span class="text-gradient-primary">{{ user?.name || 'User' }}</span>
          </h1>
          <p class="text-sm sm:text-base text-muted-foreground mt-1">
            Manage your stock requests and track their status.
          </p>
        </div>
        <div class="flex gap-2 sm:gap-3">
          <Button class="bg-gradient-primary hover:opacity-90 shadow-button text-sm sm:text-base px-3 sm:px-4">
            <Plus class="mr-1 sm:mr-2 h-4 w-4" />
            <span class="hidden min-[360px]:inline">New Request</span>
            <span class="min-[360px]:hidden">New</span>
          </Button>
        </div>
      </div>
    </template>
    
    <!-- Quick Summary Cards -->
    <div class="grid gap-3 sm:gap-4 lg:gap-6 grid-cols-1 sm:grid-cols-3 mb-6 sm:mb-8">
      <Card class="card-elevated group">
        <CardContent class="flex items-center gap-4 p-4 sm:p-6">
          <div class="h-12 w-12 rounded-lg bg-amber-500/10 flex items-center justify-center">
            <Clock class="h-6 w-6 text-amber-500" />
          </div>
          <div>
            <p class="text-2xl font-bold">3</p>
            <p class="text-sm text-muted-foreground">Pending Requests</p>
          </div>
        </CardContent>
      </Card>
      
      <Card class="card-elevated group">
        <CardContent class="flex items-center gap-4 p-4 sm:p-6">
          <div class="h-12 w-12 rounded-lg bg-accent/10 flex items-center justify-center">
            <CheckCircle2 class="h-6 w-6 text-accent" />
          </div>
          <div>
            <p class="text-2xl font-bold">12</p>
            <p class="text-sm text-muted-foreground">Approved</p>
          </div>
        </CardContent>
      </Card>
      
      <Card class="card-elevated group">
        <CardContent class="flex items-center gap-4 p-4 sm:p-6">
          <div class="h-12 w-12 rounded-lg bg-primary/10 flex items-center justify-center">
            <Send class="h-6 w-6 text-primary" />
          </div>
          <div>
            <p class="text-2xl font-bold">28</p>
            <p class="text-sm text-muted-foreground">Completed</p>
          </div>
        </CardContent>
      </Card>
    </div>
    
    <!-- My Recent Requests -->
    <Card class="card-elevated">
      <CardHeader>
        <div class="flex items-center justify-between">
          <div>
            <CardTitle class="text-base sm:text-lg">My Recent Requests</CardTitle>
            <CardDescription class="text-xs sm:text-sm">Your latest stock requests</CardDescription>
          </div>
          <Button variant="outline" size="sm" class="text-xs sm:text-sm px-2 sm:px-3">
            View All
          </Button>
        </div>
      </CardHeader>
      <CardContent>
        <div class="space-y-4">
          <div 
            v-for="request in myRequests" 
            :key="request.id"
            class="flex items-center gap-3 sm:gap-4 p-3 rounded-lg hover:bg-muted/50 transition-colors"
          >
            <div 
              class="h-10 w-10 rounded-full flex items-center justify-center flex-shrink-0"
              :class="getStatusBadge(request.status).class"
            >
              <component 
                :is="getStatusIcon(request.status)" 
                class="h-5 w-5"
              />
            </div>
            <div class="flex-1 min-w-0">
              <p class="font-medium text-sm">{{ request.title }}</p>
              <p class="text-sm text-muted-foreground truncate">{{ request.description }}</p>
            </div>
            <div class="text-right flex-shrink-0">
              <span 
                class="inline-block px-2 py-1 rounded-full text-xs font-medium"
                :class="getStatusBadge(request.status).class"
              >
                {{ getStatusBadge(request.status).text }}
              </span>
              <p class="text-xs text-muted-foreground mt-1">{{ request.date }}</p>
            </div>
          </div>
        </div>
      </CardContent>
    </Card>
  </AppLayout>
</template>
